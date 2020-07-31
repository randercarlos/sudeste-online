<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Color;
use Illuminate\Validation\ValidationException;

class ColorFeatureTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_can_list_colors()
    {
        $color = factory(Color::class)->create();
        
        $response = $this->get('/admin/colors');
        
        $response->assertSee($color->name);
    }
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_can_create_a_color()
    {
        $color = factory(Color::class)->make();
        
        $response = $this->followingRedirects()->post(route('colors.store'), [
            'name' => $color->name
        ]);
        
        $response->assertOk()
            ->assertSessionHasNoErrors();
        
        $this->assertDatabaseHas('colors', [
            'name' => $color->name
        ]);
    }
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_cannot_create_a_color_name_that_already_exists()
    {
        // create a color in database
        $color = factory(Color::class)->create();
        
        // Following redirects. Try to create a color with a name that already exists
        $response = $this->from(route('colors.create'))->followingRedirects()->post(route('colors.store'), [
            'name' => $color->name
        ]);
        
        $response->assertSee('já está cadastrado e não pode ser repetido!');
        $this->assertEquals(1, Color::get()->count());
    }
    
    
    /**
     * A basic test example.
     * 
     * @dataProvider provideInvalidData
     *
     * @return void
     */
    public function test_it_cannot_create_a_color_without_required_name_with_min_chars($data)
    {
        $response = $this->post(route('colors.store'), [
            'name' => $data
        ]);
        
        $response->assertSessionHasErrors(['name']);
    }
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_can_edit_a_color()
    {
        $color = factory(Color::class)->create();
        
        $response = $this->get(route('colors.edit', $color->id));
        
        $response
            ->assertOk()
            ->assertSee($color->name);
    }
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_cannot_edit_a_color_with_nonexistent_id()
    {
        $response = $this->get(route('colors.edit', 99999));
        
        $response->assertNotFound();
    }
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_can_update_a_color()
    {
        $color = factory(Color::class)->create();
        
        $color->name = 'Strong Silver 2';
        
        $response = $this->followingRedirects()
            ->put(route('colors.update', $color->id), [
                'name' => $color->name
            ]);
        
            
        $response->assertOk()->assertSessionHasNoErrors();
        
        $this->assertDatabaseHas('colors', [
            'name' => $color->name
        ]);
        
    }
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_cannot_update_to_a_color_name_that_already_exists()
    {
        // create two colors in database
        $color1 = factory(Color::class)->create();
        $color2 = factory(Color::class)->create();
        
        // Following redirects. Try to update a color with a name that already exists
        $response = $this->from(route('colors.edit', $color1->id))->followingRedirects()
            ->put(route('colors.update', $color1->id), [
            'name' => $color2->name
        ]);
        
        $response->assertSee($color2->name);
        $response->assertSee('já está cadastrado e não pode ser repetido!');
        
        $this->assertEquals(1, Color::whereName($color1->name)->get()->count());
        $this->assertEquals(1, Color::whereName($color2->name)->get()->count());
    }
    
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_cannot_update_a_color_with_nonexistent_id()
    {
        $response = $this->put(route('colors.update', 99999), [
                'name' => 'Testando'
            ]);
        
        $response->assertNotFound();
    }
   
    /**
     * A basic test example.
     * 
     * @dataProvider provideInvalidData
     *
     * @return void
     */
    public function test_it_cannot_update_a_color_without_a_required_name_with_min_chars($data)
    {
        $color = factory(Color::class)->create();
        
        $this->put(route('colors.update', $color->id), [
            'name' => $data
        ]);
        
        $this->assertDatabaseHas('colors', [
            'name' => $color->name   // verifies that the name has not been changed
        ]);
    }
    
    
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_can_delete_a_color()
    {
        $color = factory(Color::class)->create();
        
        $response = $this->followingRedirects()
            ->delete(route('colors.destroy', $color->id));
        
        $response->assertOk();
        
        $this->assertDatabaseMissing('colors', [
            'name' => $color->name   // verifies that the record has been destroyed in DB
        ]);
        
    }
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_cannot_delete_a_color_with_nonexistent_id()
    {
        $response = $this->delete(route('colors.destroy', 99999));
        
        $response->assertNotFound();
    }
    
    
    public function provideInvalidData()
    {
        return [
            [null],
            [''],
            ['ab']
        ];
    }
}
