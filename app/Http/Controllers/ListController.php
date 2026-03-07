<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\statusModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class ListController extends Controller
{
    // O login agora te leva para a rota 'home'
    public function login(Request $request)
    
    {
        // 1. Pega apenas o que precisa do formulário
        $credenciais = $request->only('email', 'password');

        // 2. Tenta autenticar
        if (Auth::attempt($credenciais)) {
            // Se der certo, limpa a sessão e vai para a home
            $request->session()->regenerate();
            return redirect()->route('home');
        }
        return redirect()->back()->with('erro', 'E-mail ou senha inválidos');

        
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
    // O index agora carrega o arquivo 'home.blade.php'
  public function index()
    {   
    // 1. Busca todos os status (isso continua igual para todos)
    $statusItem = statusModel::all(); 

    // 2. Filtra as tarefas: agora pegamos apenas onde o 'user_id' 
    // é igual ao ID do usuário autenticado (Andre ou Lucas)
    $tarefas = DB::table('tabela_item')
                ->where('user_id', Auth::id()) 
                ->get(); 
    
    // 3. Retorna a view 'home' com as tarefas filtradas
    return view('home', compact('tarefas', 'statusItem'));
    }

    public function store(Request $request)
{
    // 1. Valida apenas o que vem dos inputs do usuário
    $request->validate([
        'tituloTarefa' => 'required',
        'dataCriacao' => 'required',
        'prazo' => 'required',
        'status_id' => 'required',
    ]);

    // 2. Faz o insert incluindo o user_id de quem está logado
    DB::table('tabela_item')->insert([
        'tituloTarefa' => $request->tituloTarefa,
        'dataCriacao' => $request->dataCriacao,
        'prazo' => $request->prazo,
        'status_id' => $request->status_id,
        'user_id' => Auth::id(), // Vincula ao Andre ou Lucas aqui
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->back();
}

    public function destroy($id)
    {
    // O where('user_id', Auth::id()) garante que o usuário 
    // só delete o que pertence ao ID dele.
    DB::table('tabela_item')
        ->where('id', $id)
        ->where('user_id', Auth::id()) 
        ->delete();

    return redirect()->back();
    }

public function indexStatus()
{
    // Mudamos 'status.valorStatus' para 'status.valor' que é o nome real no seu banco
    $tarefasComStatus = DB::table('tabela_item')
        ->join('status', 'tabela_item.status_id', '=', 'status.id')
        ->where('tabela_item.user_id', Auth::id())
        ->select('tabela_item.*', 'status.valor') 
        ->get();

    return view('status', compact('tarefasComStatus'));
}
}