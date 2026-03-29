<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\statusModel;
use App\Models\ListModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class ListController extends Controller
{
    // O login agora ki levaa para a rota 'home'
    public function login(Request $request)
    
    {
        // 1. Pega apns o que precisa do formulário
        $credenciais = $request->only('email', 'password');

        // 2. Tenta autenticar
        if (Auth::attempt($credenciais)) {
            // Se der certoo, limpa a sessão e vai para a home
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
 
    $statusItem = statusModel::all(); 

    
    $tarefas = DB::table('tabela_item')
                ->where('user_id', Auth::id()) 
                ->get(); 
    
    // 3. Retorna a view 'home' com as tarefas filtradas
    return view('home', compact('tarefas', 'statusItem'));
    }

    //get APi ne pae
    public function indexApi(){
        $tarefas = listModel::all(); 
        return response () ->json([
            'success' => true,
            'count' => $tarefas->count(),
            'data' =>  $tarefas

        ],200);
    }

    //API DO POST  NE PAE
  public function storeApi(Request $request)
{
    try {
        $tarefas = new ListModel();
        
        $tarefas->tituloTarefa = $request->tituloTarefa; 
        $tarefas->dataCriacao  = $request->dataCriacao;
        $tarefas->prazo        = $request->prazo;
        $tarefas->status_id    = $request->status_id; 
        $tarefas->user_id      = $request->user_id ?? 1; 

        $tarefas->save();

        return response()->json([
            'success' => true,
            'message' => 'Task created successfully',
            'data' => $tarefas
        ], 201);
        
    } catch (\Exception $e) {
        
        return response()->json([
            'success' => false,
            'error' => $e->getMessage()
        ], 500);
    }
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
        'user_id' => Auth::id(), // Vincula ao Andre ou Luqueta ou qualquer outro aqui
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->back();
}



    public function destroy($id)
    {
 
    DB::table('tabela_item')
        ->where('id', $id)
        ->where('user_id', Auth::id()) 
        ->delete();

    return redirect()->back();
    }

    public function destroyApi($id){
    $tarefas = ListModel::findOrFail($id);

    $tarefas->delete();

        return response()->json([
            'success' => true,
            'message' => 'Task updated successfully'
        ], 200);
    

    }
public function indexStatus()
{

    $tarefasComStatus = DB::table('tabela_item')
        ->join('status', 'tabela_item.status_id', '=', 'status.id')
        ->where('tabela_item.user_id', Auth::id())
        ->select('tabela_item.*', 'status.valor') 
        ->get();

    return view('status', compact('tarefasComStatus'));
}


//update de API ne pae
public function updateApi(Request $request, string $id)
{
    $tarefas = ListModel::findOrFail($id);
    $tarefas->tituloTarefa = $request->tituloTarefa ?? $tarefas->tituloTarefa;
    $tarefas->dataCriacao= $request->dataCriacao ?? $tarefas->dataCriacao;
    $tarefas->prazo= $request->prazo ?? $tarefas->prazo;
    $tarefas->status_id= $request->status_id ?? $tarefas->status_id;
    $tarefas->save();

    return response() -> json(
        [
            "success"=>true,
            "message" =>'Task updated successfully',
            'data' => $tarefas
        ],200
    );
}

public function update(Request $request, $id)
{
    // Validação básica
    $request->validate([
        'tituloTarefa' => 'required',
        'status_id' => 'required',
        'prazo' => 'required'
    ]);

 
    DB::table('tabela_item')
        ->where('id', $id)
        ->where('user_id', Auth::id())
        ->update([
            'tituloTarefa' => $request->tituloTarefa,
            'status_id' => $request->status_id,
            'prazo' => $request->prazo,
            'updated_at' => now(),
        ]);

    return redirect()->back()->with('sucesso', 'Tarefa atualizada!');
}
}