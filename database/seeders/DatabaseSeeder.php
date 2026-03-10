<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Cria o usuário Andre
       User::updateOrCreate(
            ['email' => 'andre@email.com'],
            [
                'name' => 'Andre',
                'password' => Hash::make('123456') // Isso gera o código secreto corretooo
            ]
        );

        User::updateOrCreate(
        ['email' => 'lucas@email.com'], // emaill do lucas
        [
            'name' => 'Lucas',     // Nome do lucas
            'password' => Hash::make('123456') // senha do lucas
        ]
    );

    User::updateOrCreate(
        ['email' => 'maria@email.com'], // emaill do maria
        [
            'name' => 'maria',     // Nome do maria
            'password' => Hash::make('123456') // senha do maria
        ]

        
    );
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
