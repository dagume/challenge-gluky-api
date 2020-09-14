<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Category;

class CategoryControllerTest extends TestCase
{
   
    public function testShowCategory()
    {    $response = $this->withHeaders([
        'X-Header' => 'Value',
        ])->json('GET', '/api/categories/1');
        
        $response
         ->assertStatus(200)
         ->assertJsonFragment([
            'name' => 'restaurante',
        ]);

    }

    public function testSaveCategory()
    {    $response = $this->withHeaders([
        'X-Header' => 'Value',
        ])->json('POST', '/api/categories', ['name' => 'new category']);

        $response
            ->assertStatus(201);
    }

   

    public function testDeleteCategory()
    {   $this->withoutMiddleware();
         $category=new Category();
         $category->save();
        $response = $this->call('DELETE', '/api/categories/'.$category->id_category);
        $this->assertEquals(200, $response->getStatusCode());
     }

}
