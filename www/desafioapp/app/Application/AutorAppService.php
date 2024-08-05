<?php

namespace App\Application;

use App\Http\Requests\StoreAutorRequest;
use App\Http\Requests\UpdateAutorRequest;
use App\Models\Autor;
use App\Repository\AutorRepository;

class AutorAppService 
{
    private $_autorRepository = null;

    public function __construct(Autor $autorModel)
    {
        $this->_autorRepository = new AutorRepository($autorModel);
    }
       
    public function criarAutor(StoreAutorRequest $request)
    {
        return $this->_autorRepository->create($request);
    }

    public function obterAutor(Autor $autor)
    {
        return $this->_autorRepository->show($autor);
    }

    public function obterTodosAutores()
    {
        return $this->_autorRepository->showAll();
    }

    public function editarAutor(Autor $autor, UpdateAutorRequest $request)
    {
        return $this->_autorRepository->update($request,$autor);
    }

    public function deletarAutor(Autor $autor)
    {
        $autores = $this->_autorRepository->validarExclusao($autor);

        if($autores->livros->count() > 0)
        {
            return redirect()->route('autors.index')->with('error', 'Autor não pode ser excluído, pois possui livros associados');
        }

        return $this->_autorRepository->destroy($autor);
    }

    public function validarExclusao(Autor $autor)
    {
        $autores = $this->_autorRepository->validarExclusao($autor);
        
        if($autores->livros->count() > 0)
        {
            return true;
        }

        return false;
    }
}