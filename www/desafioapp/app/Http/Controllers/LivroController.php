<?php

namespace App\Http\Controllers;

use App\Application\AssuntoAppService;
use App\Application\AutorAppService;
use App\Application\LivroAppService;
use App\Http\Requests\StoreLivroRequest;
use App\Http\Requests\UpdateLivroRequest;
use App\Models\Assunto;
use App\Models\Autor;
use App\Models\Livro as Livro;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;

use function Ramsey\Uuid\v1;

class LivroController extends Controller
{
    private $_livroService = null;
    private $_autorService = null;
    private $_assuntoService = null;    

    public function __construct(Livro $livro, Autor $autor, Assunto $assunto)   
    {        
        $this->_livroService = new LivroAppService($livro);
        $this->_autorService = new AutorAppService($autor);
        $this->_assuntoService = new AssuntoAppService($assunto);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $livros = $this->_livroService->obterTodosLivros();

        return view('livros.index', compact('livros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $autores = $this->_autorService->obterTodosAutores();
        $assuntos = $this->_assuntoService->obterTodosAssuntos();
        return view('livros.create', compact('autores', 'assuntos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLivroRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLivroRequest $request)
    {
        try{
            $this->_livroService->criarLivro($request);         

            return redirect()->route('livros.index',["sucess" => "true", "mensagem" => "Livro criado com sucesso"]);
        }catch(Exception $e){
            return redirect()->route('livros.index',["sucess" => "false", "mensagem" => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Livro  $livro
     * @return \Illuminate\Http\Response
     */
    public function show(Livro $livro)
    {
        //
        $livro = $this->_livroService->obterLivro($livro);
        return view('livros.show', compact('livro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Livro  $livro
     * @return \Illuminate\Http\Response
     */
    public function edit(Livro $livro)
    {        
        $livro = $this->_livroService->obterLivro($livro);
        
        $autores = $this->_autorService->obterTodosAutores();
        $assuntos = $this->_assuntoService->obterTodosAssuntos();

        return view('livros.edit', compact('livro', 'autores', 'assuntos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLivroRequest  $request
     * @param  \App\Models\Livro  $livro
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLivroRequest $request, Livro $livro)
    {
        //
        try
        {
            $this->_livroService->editarLivro($request, $livro);

            return redirect()->route('livros.index',["sucess" => "true", "mensagem" => "Livro editado com sucesso"]);
        }catch(Exception $e){
            return redirect()->route('livros.index',["sucess" => "false", "mensagem" => $e->getMessage()]);
        }        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Livro  $livro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Livro $livro)
    {
        //
        try
        {
            $this->_livroService->deletarLivro($livro);
            return redirect()->route('livros.index',["sucess" => "true", "mensagem" => "Livro deletado com sucesso"]);
        }catch(Exception $e){
            return redirect()->route('livros.index',["sucess" => "false", "mensagem" => $e->getMessage()]);
        }        
    }

    public function gerarRelatorioPDF()
    {
        //
        $dadosRelatorio = $this->_livroService->obterDadosRelatorioPDF();
        //dd($dadosRelatorio);
        //return view('livros.relatoriopdf', compact('dadosRelatorio'));
        return Pdf::loadView('livros.relatoriopdf', compact('dadosRelatorio'))->stream("relatorio-livros.pdf");
    }
}
