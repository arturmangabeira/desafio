<?php

namespace App\Repository;

use App\Http\Requests\StoreLivroRequest;
use App\Http\Requests\UpdateLivroRequest;
use App\Models\Livro;
use Exception;
use Facade\Ignition\QueryRecorder\Query;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class LivroRepository
{
    //$_livroModel is an instance of the Livro model
    private $_livroModel = null;

    public function __construct(Livro $livroModel)
    {
        $this->_livroModel = $livroModel;
    }

    public function create(StoreLivroRequest $request)
    {
        try{
            $livro = $this->_livroModel->create($request->all());

            $livro->autores()->attach($request->autores);
            $livro->assuntos()->attach($request->assuntos);

            return true;
        }catch(QueryException $eq){
            throw new Exception("Ocorreu um erro ao tentar executar o registro: Erro: ".$eq->getMessage());
        }catch(Exception $e){
            throw new Exception("Erro: ".$e->getMessage());
        }
    }

    public function showAll()
    {
        return $this->_livroModel::with(['autores','assuntos'])->paginate(10);
    }

    public function show(Livro $livro)
    {
        return $this->_livroModel::with(['autores','assuntos'])->find($livro->Codl);
    }

    public function update(UpdateLivroRequest $request,Livro $livro)
    {
        try{

            $livro = $this->_livroModel::find($livro->Codl);

            $this->_livroModel->update($request->all());

            $livro->autores()->detach();
            $livro->assuntos()->detach();

            $livro->autores()->sync($request->autores);
            $livro->assuntos()->sync($request->assuntos);

            return true;
        }catch(QueryException $eq){
            throw new Exception("Ocorreu um erro ao tentar atulizar o registro: Erro: ".$eq->getMessage());
        }catch(Exception $e){
            throw new Exception("Erro: ".$e->getMessage());
        }       
    }

    public function destroy(Livro $livro)
    {
        try{

            $livro = $this->_livroModel::find($livro->Codl);

            $livro->autores()->detach();
            $livro->assuntos()->detach();
            
            $livro->delete();

            return true;

        }catch(QueryException $eq){
            throw new Exception("Ocorreu um erro ao tentar excluir o registro: Erro: ".$eq->getMessage());
        }catch(Exception $e){
            throw new Exception("Erro: ".$e->getMessage());
        } 
    }

    public function obterDadosRelatorioPDF()
    {
        return $results = DB::select("SELECT Codl,Titulo,Editora,Edicao,AnoPublicacao,Valor ,
                                             CodAu, Nome ,
                                             CodAs , Descricao  
                                       FROM relatorioLivros");
    }
}