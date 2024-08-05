<?php

namespace App\Repository;

use App\Http\Requests\StoreAssuntoRequest;
use App\Http\Requests\UpdateAssuntoRequest;
use App\Models\Assunto;
use Exception;
use Illuminate\Database\QueryException;

class AssuntoRepository
{
    //$_assuntoModel is an instance of the Assunto model
    private $_assuntoModel = null;

    public function __construct(Assunto $assuntoModel)
    {
        $this->_assuntoModel = $assuntoModel;
    }

    public function create(StoreAssuntoRequest $request)
    {
        try{
            $assunto = $this->_assuntoModel->create($request->all());

            return true;
        }catch(QueryException $eq){
            throw new Exception("Ocorreu um erro ao tentar criar o registro: Erro: ".$eq->getMessage());
        }catch(Exception $e){
            throw new Exception("Erro: ".$e->getMessage());
        } 
    }

    public function showAll()
    {
        return $this->_assuntoModel->paginate(10);
    }

    public function show(Assunto $assunto)
    {
        return $this->_assuntoModel::find($assunto->CodAs); 
    }

    public function update(UpdateAssuntoRequest $request,Assunto $assunto)
    {
        try{

            $assunto = $this->_assuntoModel::find($assunto->CodAs);

            $assunto->update($request->all());

            return true;
        }catch(QueryException $eq){
            throw new Exception("Ocorreu um erro ao tentar atualizar o registro: Erro: ".$eq->getMessage());
        }catch(Exception $e){
            throw new Exception("Erro: ".$e->getMessage());
        } 
       
    }

    public function destroy(Assunto $assunto)
    {
        try{
            $assunto = $this->_assuntoModel::find($assunto->CodAs);
           
            $assunto->delete();
            return true;
        }catch(QueryException $eq){
            throw new Exception("Ocorreu um erro ao tentar excluir o registro: Erro: ".$eq->getMessage());
        }catch(Exception $e){
            throw new Exception("Erro: ".$e->getMessage());
        } 
    }

    public function validarExclusao(Assunto $assunto)
    {
        return $this->_assuntoModel::with(['livros'])->find($assunto->CodAs);
    }
}