<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LivroTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/livros');

        $response->assertStatus(200);
    }

    /** @test*/
    public function canCreateLivro()
    {
        $data = [
            'Titulo' => "Teste de nome",
            'Editora' => "Teste de editora",
            'Edicao' => "Teste de edicao",
            'AnoPublicacao' => "2021",
            'Valor' => "10.00",
            'autores' => [1,2],
            'assuntos' => [1,2]
        ];

        $response = $this->json('POST', '/livros', $data);

        $response->assertStatus(201)
             ->assertJson(compact('data'));

        $this->assertDatabaseHas('posts', [
          'Nome' => $data['Nome']
        ]);
    }

    /** @test*/
    public function canEditLivro()
    {
        $data = [
            'Codl' => 14,
            'Titulo' => "Teste de nome Editado",
            'Editora' => "Teste de editora Editado",
            'Edicao' => "Teste de edicao Editado",
            'AnoPublicacao' => "2021",
            'Valor' => "10.00",
            'autores' => [1,2],
            'assuntos' => [1,2]
        ];

        $response = $this->json('PUT', '/autors', $data);

        $response->assertStatus(201)
             ->assertJson(compact('data'));

        $this->assertDatabaseHas('posts', [
          'Nome' => $data['Nome']
        ]);
    }
}
