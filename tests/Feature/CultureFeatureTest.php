<?php

namespace Tests\Feature;

use App\Models\Culture;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tymon\JWTAuth\Facades\JWTAuth;

class CultureFeatureTest extends TestCase
{
    use RefreshDatabase;

    private $token;

    protected function setUp(): void
    {
        parent::setUp();

        // configure the jwt and refresh expires to only 1 minute because it's a test.
        config(['jwt.ttl' => 1, 'refresh_ttl' => 1]);

        // create a user
        $user = factory(User::class)->create();

        // generate a JWT Token from user inserted in DB and save in $token property
        $this->token = JWTAuth::fromUser($user);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_can_list_cultures()
    {
        // create 10 cultures
        factory(Culture::class, 10)->create();

        $response = $this->get('/api/cultures', ['Authorization' => 'Bearer ' . $this->token]);

        $response
            ->assertOk()
            ->assertJsonCount(10)
            ->assertJsonStructure([
                '*' => [
                    'id', 'name', 'created_at', 'updated_at'
                ]
            ]);
    }

    public function test_it_can_show_a_culture()
    {
        $culture = factory(Culture::class)->create();

        $response = $this->get('/api/cultures/' . $culture->id, ['Authorization' => 'Bearer ' . $this->token]);

        $response
            ->assertOk()
            ->assertJsonStructure([
                'id', 'name', 'created_at', 'updated_at'
            ]);
    }

    public function test_it_cant_show_a_culture_with_nonexistent_id()
    {
        factory(Culture::class)->create();

        $response = $this->get('/api/cultures/9999999', ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertNotFound();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_can_create_a_culture()
    {
        $culture = factory(Culture::class)->make();

        $response = $this->post('/api/cultures', [
            'name' => $culture->name
        ], ['Authorization' => 'Bearer ' . $this->token]);

        $response
            ->assertCreated()
            ->assertJson([
                'name' => $culture->name
            ])
            ->assertJsonStructure([
                'id', 'name', 'created_at', 'updated_at'
            ]);

        $this->assertDatabaseCount('cultures', 1);

        $this->assertDatabaseHas('cultures', [
            'name' => $culture->name
        ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_cannot_create_a_culture_name_that_already_exists()
    {
        // create a culture in database
        $culture = factory(Culture::class)->create();

        // Following redirects. Try to create a culture with a name that already exists
        $response = $this->post('/api/cultures', [
            'name' => $culture->name
        ], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        // make sure there are 1 only
        $this->assertDatabaseCount('cultures', 1);
    }


    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_cannot_create_a_culture_without_required_name()
    {
        $response = $this->post('/api/cultures', [], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        $response = $this->post('/api/cultures', [
            'name'
        ], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        // make sure there are no culture
        $this->assertDatabaseCount('cultures', 0);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_can_update_a_culture()
    {
        $culture = factory(Culture::class)->create();

        $response = $this->put('/api/cultures/' . $culture->id, [
            'name' => 'Plantação de milho'
        ], ['Authorization' => 'Bearer ' . $this->token]);

        $response
            ->assertOk()
            ->assertJson([
                'name' => 'Plantação de milho'
            ])
            ->assertJsonStructure([
                'id', 'name', 'created_at', 'updated_at'
            ]);

        $this->assertDatabaseCount('cultures', 1);

        $this->assertDatabaseHas('cultures', [
            'name' => 'Plantação de milho'
        ]);

    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_cannot_update_to_a_culture_name_that_already_exists()
    {
        // create a culture in database
        $culture1 = factory(Culture::class)->create();
        $culture2 = factory(Culture::class)->create();

        // Following redirects. Try to create a culture with a name that already exists
        $response = $this->put('/api/cultures/' . $culture1->id, [
            'name' => $culture2->name
        ], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        $this->assertDatabaseCount('cultures', 2);

        $this->assertDatabaseHas('cultures', [
            'name' => $culture1->name
        ]);

        $this->assertDatabaseHas('cultures', [
            'name' => $culture2->name
        ]);
    }


    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_cannot_update_a_culture_with_nonexistent_id()
    {
        $response = $this->put('/api/cultures/999999', [
            'name' => 'Testando'
        ], ['Authorization' => 'Bearer ' . $this->token]);

//        dd($response->decodeResponseJson());
        $response->assertNotFound();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_cannot_update_a_culture_without_a_required_name()
    {
        $culture = factory(Culture::class)->create();

        $response = $this->put('/api/cultures/' . $culture->id, [], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        $response = $this->put('/api/cultures/' . $culture->id, [
            'name'
        ], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        // make sure there are no culture
        $this->assertDatabaseCount('cultures', 1);
    }


    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_can_delete_a_culture()
    {
        $culture = factory(Culture::class)->create();

        $response = $this->delete('/api/cultures/' . $culture->id, [], ['Authorization' => 'Bearer ' . $this->token]);

        $response
            ->assertOk()
            ->assertJsonStructure([
                'id', 'name', 'created_at', 'updated_at'
            ]);

        $this->assertDatabaseCount('cultures', 0);

    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_cannot_delete_a_culture_with_nonexistent_id()
    {
        factory(Culture::class)->create();

        $response = $this->delete('/api/cultures/999999', [], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertNotFound();

        $this->assertDatabaseCount('cultures', 1);
    }
}
