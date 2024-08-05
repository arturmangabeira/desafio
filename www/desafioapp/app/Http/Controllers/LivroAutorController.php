<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLivro_AutorRequest;
use App\Http\Requests\UpdateLivro_AutorRequest;
use App\Models\Livro_Autor;

class LivroAutorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLivro_AutorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLivro_AutorRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Livro_Autor  $livro_Autor
     * @return \Illuminate\Http\Response
     */
    public function show(Livro_Autor $livro_Autor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Livro_Autor  $livro_Autor
     * @return \Illuminate\Http\Response
     */
    public function edit(Livro_Autor $livro_Autor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLivro_AutorRequest  $request
     * @param  \App\Models\Livro_Autor  $livro_Autor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLivro_AutorRequest $request, Livro_Autor $livro_Autor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Livro_Autor  $livro_Autor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Livro_Autor $livro_Autor)
    {
        //
    }
}
