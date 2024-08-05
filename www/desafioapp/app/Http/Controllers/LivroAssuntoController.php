<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLivro_AssuntoRequest;
use App\Http\Requests\UpdateLivro_AssuntoRequest;
use App\Models\Livro_Assunto;

class LivroAssuntoController extends Controller
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
     * @param  \App\Http\Requests\StoreLivro_AssuntoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLivro_AssuntoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Livro_Assunto  $livro_Assunto
     * @return \Illuminate\Http\Response
     */
    public function show(Livro_Assunto $livro_Assunto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Livro_Assunto  $livro_Assunto
     * @return \Illuminate\Http\Response
     */
    public function edit(Livro_Assunto $livro_Assunto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLivro_AssuntoRequest  $request
     * @param  \App\Models\Livro_Assunto  $livro_Assunto
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLivro_AssuntoRequest $request, Livro_Assunto $livro_Assunto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Livro_Assunto  $livro_Assunto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Livro_Assunto $livro_Assunto)
    {
        //
    }
}
