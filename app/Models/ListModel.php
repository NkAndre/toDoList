<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListModel extends Model
{
    use HasFactory;

    protected $table = 'tabela_item'; 
    
    
    protected $fillable = [
    'tituloTarefa', 
    'dataCriacao', 
    'prazo', 
    'status_id', 
    'user_id'
];
 
    public $timestamps = false; 
}