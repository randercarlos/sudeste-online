<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Prague;
use Tymon\JWTAuth\Facades\JWTAuth;

class PragueFeatureTest extends TestCase
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
    public function test_it_can_list_pragues()
    {
        // create 10 pragues
        factory(Prague::class, 10)->create();

        $response = $this->get('/api/pragues', ['Authorization' => 'Bearer ' . $this->token]);

        $response
            ->assertOk()
            ->assertJsonCount(10)
            ->assertJsonStructure([
                '*' => [
                    'id', 'name', 'created_at', 'updated_at'
                ]
            ]);
    }

    public function test_it_can_show_a_prague()
    {
        $prague = factory(Prague::class)->create();

        $response = $this->get('/api/pragues/' . $prague->id, ['Authorization' => 'Bearer ' . $this->token]);

        $response
            ->assertOk()
            ->assertJsonStructure([
                'id', 'name', 'created_at', 'updated_at'
            ]);
    }

    public function test_it_cant_show_a_prague_with_nonexistent_id()
    {
        // create 10 pragues
        factory(Prague::class)->create();

        $response = $this->get('/api/pragues/9999999', ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertNotFound();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_can_create_a_prague()
    {
        $prague = factory(Prague::class)->make();

        $response = $this->post('/api/pragues', [
            'name' => $prague->name
        ], ['Authorization' => 'Bearer ' . $this->token]);

        $response
            ->assertCreated()
            ->assertJson([
                'name' => $prague->name
            ])
            ->assertJsonStructure([
                'id', 'name', 'created_at', 'updated_at'
            ]);

        $this->assertDatabaseCount('pragues', 1);

        $this->assertDatabaseHas('pragues', [
            'name' => $prague->name
        ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_cannot_create_a_prague_name_that_already_exists()
    {
        // create a prague in database
        $prague = factory(Prague::class)->create();

        // Following redirects. Try to create a prague with a name that already exists
        $response = $this->post('/api/pragues', [
            'name' => $prague->name
        ], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        // make sure there are 1 only
        $this->assertDatabaseCount('pragues', 1);
    }


    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_cannot_create_a_prague_without_required_name()
    {
        $response = $this->post('/api/pragues', [], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        $response = $this->post('/api/pragues', [
            'name'
        ], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        // make sure there are no prague
        $this->assertDatabaseCount('pragues', 0);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_can_update_a_prague()
    {
        $prague = factory(Prague::class)->create();

        $response = $this->put('/api/pragues/' . $prague->id, [
            'name' => 'Sprite 2L sem açúcar'
        ], ['Authorization' => 'Bearer ' . $this->token]);

        $response
            ->assertOk()
            ->assertJson([
                'name' => 'Sprite 2L sem açúcar'
            ])
            ->assertJsonStructure([
                'id', 'name', 'created_at', 'updated_at'
            ]);

        $this->assertDatabaseCount('pragues', 1);

        $this->assertDatabaseHas('pragues', [
            'name' => 'Sprite 2L sem açúcar'
        ]);

    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_cannot_update_to_a_prague_name_that_already_exists()
    {
        // create a prague in database
        $prague1 = factory(Prague::class)->create();
        $prague2 = factory(Prague::class)->create();

        // Following redirects. Try to create a prague with a name that already exists
        $response = $this->put('/api/pragues/' . $prague1->id, [
            'name' => $prague2->name
        ], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        $this->assertDatabaseCount('pragues', 2);

        $this->assertDatabaseHas('pragues', [
            'name' => $prague1->name
        ]);

        $this->assertDatabaseHas('pragues', [
            'name' => $prague2->name
        ]);
    }


    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_cannot_update_a_prague_with_nonexistent_id()
    {
        $response = $this->put('/api/pragues/999999', [
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
    public function test_it_cannot_update_a_prague_without_a_required_name()
    {
        $prague = factory(Prague::class)->create();

        $response = $this->put('/api/pragues/' . $prague->id, [], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        $response = $this->put('/api/pragues/' . $prague->id, [
            'name'
        ], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        // make sure there are no prague
        $this->assertDatabaseCount('pragues', 1);
    }


    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_can_delete_a_prague()
    {
        $prague = factory(Prague::class)->create();

        $response = $this->delete('/api/pragues/' . $prague->id, [], ['Authorization' => 'Bearer ' . $this->token]);

        $response
            ->assertOk()
            ->assertJsonStructure([
                'id', 'name', 'created_at', 'updated_at'
            ]);

        $this->assertDatabaseCount('pragues', 0);

    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_cannot_delete_a_prague_with_nonexistent_id()
    {
        factory(Prague::class)->create();

        $response = $this->delete('/api/pragues/999999', [], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertNotFound();

        $this->assertDatabaseCount('pragues', 1);
    }
}
