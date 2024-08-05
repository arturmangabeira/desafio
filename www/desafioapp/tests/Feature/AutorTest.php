<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AutorTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/autors');

        $response->assertStatus(200);
    }

    /** @test*/
    public function canCreateAutor()
    {
        $data = [
            'Nome' => "Teste de nome"
        ];

        $response = $this->json('POST', '/autors', $data);

        $response->assertStatus(201)
             ->assertJson(compact('data'));

        $this->assertDatabaseHas('posts', [
          'Nome' => $data['Nome']
        ]);
    }
}
