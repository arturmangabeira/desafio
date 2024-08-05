<?php

namespace App\Application;

use App\Http\Requests\StoreAssuntoRequest;
use App\Http\Requests\UpdateAssuntoRequest;
use App\Models\Assunto;
use App\Repository\AssuntoRepository;

class AssuntoAppService 
{
    private $_assuntoRepository = null;

    public function __construct(Assunto $assuntoModel)
    {
        $this->_assuntoRepository = new AssuntoRepository($assuntoModel);
    }
       
    public function criarAssunto(StoreAssuntoRequest $request)
    {
        return $this->_assuntoRepository->create($request);
    }

    public function obterAssunto(Assunto $assunto)
    {
        return $this->_assuntoRepository->show($assunto);
    }

    public function obterTodosAssuntos()
    {
        return $this->_assuntoRepository->showAll();
    }

    public function editarAssunto(Assunto $assunto, UpdateAssuntoRequest $request)
    {
        return $this->_assuntoRepository->update($request,$assunto);
    }

    public function deletarAssunto(Assunto $assunto)
    {
        $assuntos = $this->_assuntoRepository->validarExclusao($assunto);

        if($assuntos->livros->count() > 0)
        {
            return redirect()->route('assuntos.index')->with('error', 'Assunto não pode ser excluído, pois possui livros associados');
        }

        return $this->_assuntoRepository->destroy($assunto);
    }

    public function validarExclusaoAssunto(Assunto $assunto)
    {
        $assuntos = $this->_assuntoRepository->validarExclusao($assunto);
        
        if($assuntos->livros->count() > 0)
        {
            return true;
        }

        return false;
    }
}