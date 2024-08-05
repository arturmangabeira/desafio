<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;

    public $table = 'Livro';

    protected  $primaryKey = 'Codl';

    protected $fillable = ['Titulo', 'Editora', 'Edicao', 'AnoPublicacao', 'Valor'];

    public $timestamps = false;

    public function autores()
    {
        return $this->belongsToMany(Autor::class, 'Livro_Autor', 'Livro_Codl');
    }

    public function assuntos()
    {
        return $this->belongsToMany(Assunto::class, 'Livro_Assunto', 'Livro_Codl');
    }

    public static function boot()
    {
        parent::boot();

        self::updating(function ($model) 
        {            
            $model->Valor = str_replace(",",".",$model->Valor);            
        });

        self::saving(function ($model) 
        {            
            $model->Valor = str_replace(",",".",$model->Valor);            
        });
    }
}
