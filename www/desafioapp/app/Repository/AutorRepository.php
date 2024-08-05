<?php

namespace App\Repository;

use App\Http\Requests\StoreAutorRequest;
use App\Http\Requests\UpdateAutorRequest;
use App\Models\Autor;

class AutorRepository
{
    //$_autorModel is an instance of the Autor model
    private $_autorModel = null;

    public function __construct(Autor $autorModel)
    {
        $this->_autorModel = $autorModel;
    }

    public function create(StoreAutorRequest $request)
    {
        try{
            $autor = $this->_autorModel->create($request->all());

            return true;
        }catch(\Exception $e){
            return false;
        }
    }

    public function showAll()
    {
        return $this->_autorModel->paginate(10);
    }

    public function show(Autor $autor)
    {
        return $this->_autorModel::find($autor->CodAu);
    }

    public function update(UpdateAutorRequest $request,Autor $autor)
    {
        try{

            $autor = $this->_autorModel::find($autor->CodAu);

            $autor->update($request->all());

            return true;
        }catch(\Exception $e){
            return false;
        }
       
    }

    public function destroy(Autor $autor)
    {
        try{
            $autor = $this->_autorModel::with(['livros'])->find($autor->CodAu);

            $autor->delete();
        return true;
        }catch(\Exception $e){
            return false;
        }   
    }

    public function validarExclusao(Autor $autor)
    {
        return $this->_autorModel::with(['livros'])->find($autor->CodAu);
    }
}