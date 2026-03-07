<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\statusModel::insert([
        ['valor' => 'Em andamento', 'created_at' => now(), 'updated_at' => now()],
        ['valor' => 'Concluído', 'created_at' => now(), 'updated_at' => now()],
        ['valor' => 'Atrasado', 'created_at' => now(), 'updated_at' => now()],
    ]);
        //
    }
}
