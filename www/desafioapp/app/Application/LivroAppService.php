<?php

namespace App\Application;

use App\Http\Requests\StoreLivroRequest;
use App\Http\Requests\UpdateLivroRequest;
use App\Models\Livro;
use App\Repository\LivroRepository;
use Exception;

class LivroAppService 
{
    private $_livroRepository = null;

    public function __construct(Livro $livroModel)
    {
        $this->_livroRepository = new LivroRepository($livroModel);
    }
       
    public function criarLivro(StoreLivroRequest $request)
    {        
        return $this->_livroRepository->create($request);        
    }

    public function obterLivro(Livro $livro)
    {
        return $this->_livroRepository->show($livro);
    }

    public function obterTodosLivros()
    {
        return $this->_livroRepository->showAll();
    }

    public function editarLivro(UpdateLivroRequest $request, Livro $livro)
    {
        return $this->_livroRepository->update($request,$livro);
    }

    public function deletarLivro($livro)
    {
        return $this->_livroRepository->destroy($livro);
    }

    public function obterDadosRelatorioPDF()
    {
        $livros = $this->_livroRepository->obterDadosRelatorioPDF();

        $livrosAgrupdadosPorAutor = [];

        foreach($livros as $livro)
        {            
            $livrosAgrupdadosPorAutor[$livro->CodAu][] = $livro;            
        }

        $livroAssunto = [];

        foreach($livrosAgrupdadosPorAutor as $livros)
        {            
            foreach($livros as $livro)
            {                
                if(count($livroAssunto) == 0 || !array_key_exists($livro->CodAu, $livroAssunto))
                {
                    $livroAssunto[$livro->CodAu]["Livros"][] = $livro;                    
                    $livroAssunto[$livro->CodAu]["Autor"] = $livro->Nome;
                    $livroAssunto[$livro->CodAu]["Assuntos"][] = ["Codl" => $livro->Codl, "Descricao" => $livro->Descricao];                    
                }
                else
                {
                    $codl = $livro->Codl;
                    
                    foreach ($livroAssunto[$livro->CodAu] as $livroAssuntoLivros) 
                    {

                        if(is_array($livroAssuntoLivros) && is_object($livroAssuntoLivros[0]))
                        {
                            foreach ($livroAssuntoLivros as $dadoslivro) 
                            {
                                $filtered_array = $dadoslivro->Codl == $codl;
                                
                                if($filtered_array)
                                {
                                    break;
                                }
                            }
                        }
                    }

                    if(!$filtered_array)
                    {
                        $livroAssunto[$livro->CodAu]["Livros"][] = $livro;       
                        $livroAssunto[$livro->CodAu]["Assuntos"][] = ["Codl" => $livro->Codl, "Descricao" => $livro->Descricao];                                         
                    }
                    else
                    {                        
                        $livroAssunto[$livro->CodAu]["Assuntos"][] = ["Codl" => $livro->Codl, "Descricao" => $livro->Descricao];
                    }  
                }
            }                        
        }

        //dd($livroAssunto);

        return $livroAssunto;
    }
}