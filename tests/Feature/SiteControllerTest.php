<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Category;

class CategoryControllerTest extends TestCase
{
   
    public function testAllSites()
    {    $response = $this->withHeaders([
        'X-Header' => 'Value',
        ])->json('GET', '/api/sites');
        
        $response
         ->assertStatus(200)
         ->assertJsonFragment([
            'id_site' => '2',
        ]);

    }


}
