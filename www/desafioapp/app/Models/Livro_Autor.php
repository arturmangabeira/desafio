<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro_Autor extends Model
{
    use HasFactory;

    public $table = 'Livro_Autor';

    public $timestamps = false;

    protected  $primaryKey = ['Livro_Codl','Autor_CodAu'];

}
