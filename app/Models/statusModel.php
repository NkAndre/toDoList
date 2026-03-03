<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class statusModel extends Model
{   
    protected $table = 'status';

  

    public $fillable = ['valor'];

    
    //public $timestamps=false
    use HasFactory;
}
