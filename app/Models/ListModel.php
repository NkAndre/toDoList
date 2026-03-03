<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListModel extends Model
{
    
        protected $table = 'tabela_item'; 
        protected $fillable = ['tituloTarefa' ,'dataCriacao', 'prazo'];
    
    
    //public $timestamps=false
    use HasFactory;
}
