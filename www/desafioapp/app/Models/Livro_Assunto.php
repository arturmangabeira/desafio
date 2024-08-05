<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro_Assunto extends Model
{
    use HasFactory;

    public $table = 'Livro_Assunto';

    public $timestamps = false;

    protected  $primaryKey = ['Livro_Codl','Assunto_CodAs'];
}
