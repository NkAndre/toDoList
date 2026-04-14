<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ListModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tabela_item')->insert([
        ['tituloTarefa' => 'Estudar pro cna','dataCriacao' => '2026-04-14','prazo'=>'2026-04-18','user_id'=>1,"status_id"=>1],
        ['tituloTarefa' => 'Estudar pro eliza','dataCriacao' => '2026-04-15','prazo'=>'2026-04-18','user_id'=>1,"status_id"=>3],
        ['tituloTarefa' => 'Estudar pro enem','dataCriacao' => '2026-04-16','prazo'=>'2026-04-18','user_id'=>1,"status_id"=>3],
        ['tituloTarefa' => 'Estudar e tenta','dataCriacao' => '2026-05-14','prazo'=>'2026-07-18', 'user_id'=>1,"status_id"=>3],
        ['tituloTarefa' => 'Limpar a casa','dataCriacao' => '2026-06-24','prazo'=>'2026-07-18','user_id'=>1,"status_id"=>1]
        ]);
        //
    }
}
