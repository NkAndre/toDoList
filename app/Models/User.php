<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Voltando para o padrão do ToDoList
    protected $table = 'users'; 
    protected $primaryKey = 'id'; 

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public $timestamps = true; // Geralmente ToDoList usa timestamps (created_at/updated_at)

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // Garante que o Laravel lide bem com a criptografia
    ];
}