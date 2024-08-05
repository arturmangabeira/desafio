<?php

namespace App\Http\Controllers;

use App\Application\AssuntoAppService;
use App\Http\Requests\StoreAssuntoRequest;
use App\Http\Requests\UpdateAssuntoRequest;
use App\Models\Assunto;
use Exception;

class AssuntoController extends Controller
{

    private $_assuntoAppService = null;

    public function __construct(Assunto $assuntoModel)
    {
        $this->_assuntoAppService = new AssuntoAppService($assuntoModel);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $assuntos = $this->_assuntoAppService->obterTodosAssuntos();

        return view('assuntos.index', compact('assuntos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('assuntos.create');            
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAssuntoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAssuntoRequest $request)
    {
        //
        try
        {
            $this->_assuntoAppService->criarAssunto($request);            
            return redirect()->route('assuntos.index',["sucess" => "true", "mensagem" => "Assunto criado com sucesso"]);
        }catch(Exception $e){
            return redirect()->route('assuntos.index',["sucess" => "false", "mensagem" => $e->getMessage()]);
        }        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Assunto  $assunto
     * @return \Illuminate\Http\Response
     */
    public function show(Assunto $assunto)
    {
        //
        $assunto = $this->_assuntoAppService->obterAssunto($assunto);
        return view('assuntos.show', compact('assunto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Assunto  $assunto
     * @return \Illuminate\Http\Response
     */
    public function edit(Assunto $assunto)
    {
        $assunto = $this->_assuntoAppService->obterAssunto($assunto);
        return view('assuntos.edit', compact('assunto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAssuntoRequest  $request
     * @param  \App\Models\Assunto  $assunto
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAssuntoRequest $request, Assunto $assunto)
    {
        //
        try
        {
            $this->_assuntoAppService->editarAssunto($assunto, $request);            
            return redirect()->route('assuntos.index',["sucess" => "true", "mensagem" => "Assunto atualizado com sucesso"]);
        }catch(Exception $e){
            return redirect()->route('assuntos.index',["sucess" => "false", "mensagem" => $e->getMessage()]);
        }           
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Assunto  $assunto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assunto $assunto)
    {
        //
        try
        {
            $this->_assuntoAppService->deletarAssunto($assunto);            
            return redirect()->route('assuntos.index',["sucess" => "true", "mensagem" => "Assunto excluído com sucesso"]);
        }catch(Exception $e){
            return redirect()->route('assuntos.index',["sucess" => "false", "mensagem" => $e->getMessage()]);
        }
    }

    public function validarExclusaoAssunto(Assunto $assunto)
    {
        $retornoValidar = $this->_assuntoAppService->validarExclusaoAssunto($assunto);

        $retorno = ["sucess" => false, "message" => ""];

        if($retornoValidar)
        {
            $retorno["message"] = "Não é possível excluir o assunto, pois existem livros associados a ele.";            
        }
        else
        {
            $retorno["sucess"] = true;
        }
        
        return response()->json($retorno);
    }
}
