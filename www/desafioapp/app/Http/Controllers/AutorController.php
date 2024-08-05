<?php

namespace App\Http\Controllers;

use App\Application\AutorAppService;
use App\Http\Requests\StoreAutorRequest;
use App\Http\Requests\UpdateAutorRequest;
use App\Models\Autor;
use Exception;
use Facade\FlareClient\Http\Response;

class AutorController extends Controller
{

    private $_autorAppService = null;

    public function __construct(Autor $autorModel)
    {
        $this->_autorAppService = new AutorAppService($autorModel);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $autores = $this->_autorAppService->obterTodosAutores();
        return view('autors.index', compact('autores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('autors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAutorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAutorRequest $request)
    {  
        try
        {
            $this->_autorAppService->criarAutor($request);            
            return redirect()->route('autors.index',["sucess" => "true", "mensagem" => "Autor criado com sucesso"]);
        }
        catch(Exception $e)
        {
            return redirect()->route('autors.index',["sucess" => "false", "mensagem" => $e->getMessage()]);
        }              
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function show(Autor $autor)
    {
        $autor = $this->_autorAppService->obterAutor($autor);
        return view('autors.show', compact('autor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function edit(Autor $autor)
    {
        $autor = $this->_autorAppService->obterAutor($autor);  
        return view('autors.edit', compact('autor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAutorRequest  $request
     * @param  \App\Models\Autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAutorRequest $request, Autor $autor)
    {
        //
        try{
            $this->_autorAppService->editarAutor($autor, $request);
            return redirect()->route('autors.index',["sucess" => "true", "mensagem" => "Autor atualizado com sucesso"]);
        }catch(Exception $e){
            return redirect()->route('autors.index',["sucess" => "false", "mensagem" => $e->getMessage()]);
        }        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Autor $autor)
    {
        try{
            $this->_autorAppService->deletarAutor($autor);
            return redirect()->route('autors.index',["sucess" => "true", "mensagem" => "Autor excluído com sucesso"]);
        }catch(Exception $e){
            return redirect()->route('autors.index',["sucess" => "false", "mensagem" => $e->getMessage()]);        }
        
    }

    public function validarExclusaoAutor(Autor $autor)
    {        
        $retorno = ["sucess" => "", "message" => ""];

        $retornoValidar = $this->_autorAppService->validarExclusao($autor);

        if($retornoValidar)
        {
            $retorno["sucess"] = false;
            $retorno["message"] = "Autor não pode ser excluído, pois possui livros associados";
        }
        else
        {
            $retorno["sucess"] = true;
        }

        return response()->json($retorno, 200);
    }
}
