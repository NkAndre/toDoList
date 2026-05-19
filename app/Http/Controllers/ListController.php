<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\statusModel;
use App\Models\ListModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ListController extends Controller
{
    /**
     * Sistema de Login Web
     */
    public function login(Request $request)
    {

        $credenciais = $request->only('email', 'password');

        if (Auth::attempt($credenciais)) {
            $request->session()->regenerate();
            return redirect()->intended('home');
        }

        return redirect()->back()->with('erro', 'E-mail ou senha inválidos');
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    /**
     * Listagem de Tarefas (Web)
     */
    /** public function index()
    {   
        $statusItem = statusModel::all(); 

        // Filtra as tarefas apenas do usuário logado
        $tarefas = DB::table('tabela_item')
                    ->where('user_id', Auth::id()) 
                    ->get(); 
        
        return view('home', compact('tarefas', 'statusItem'));
    }*/

    public function index()
    {
        $statusItem = statusModel::all();

        // Consulta 1: Filtro simples com Eloquent
        $tarefas = ListModel::where('user_id', Auth::id())->get();

        return view('home', compact('tarefas', 'statusItem'));
    }

    public function tarefasUrgentes()
    {
        // Consulta 2: Filtro com AND 
        $tarefas = ListModel::where([
            ['user_id', '=', Auth::id()],
            ['status_id', '=', 1],
            ['prazo', '<=', now()]
        ])->get();

        return view('urgentes', compact('tarefas'));
    }

    public function buscarPrioridades()
    {
        // consulta 3: uso de orWhere
        $tarefas = ListModel::where('user_id', Auth::id())
            ->where('tituloTarefa', 'like', '%Estudar%')
            ->orWhere('tituloTarefa', 'like', '%Trabalhar%')
            ->get();

        return view('home', compact('tarefas'));
    }

    public function tarefasDoMes()
    {
        // Consulta 4: Filtro de data e ordenação
        $tarefas = ListModel::where('user_id', Auth::id())
            ->whereMonth('dataCriacao', date('m'))
            ->orderBy('dataCriacao', 'desc')
            ->get();

        return view('home', compact('tarefas'));
    }


    public function dashboard()
    {
        $userId = Auth::id();
        $hoje = now()->format('Y-m-d');

    
        $STATUS_EM_ANDAMENTO = 4;
        $STATUS_CONCLUIDO     = 5;
        $STATUS_ATRASADA      = 6;

        // Total de tarefas do usuário
        $total = DB::table('tabela_item')->where('user_id', $userId)->count();

        // TAREFAS PENDENTES / EM ANDAMENTO
        $pendentes = DB::table('tabela_item')
            ->where('user_id', $userId)
            ->where('status_id', '!=', $STATUS_CONCLUIDO)
            ->where('status_id', '!=', $STATUS_ATRASADA)
            ->where('prazo', '>=', $hoje)
            ->count();

        // TAREFAS CONCLUÍDAS
        $concluidas = DB::table('tabela_item')
            ->where('user_id', $userId)
            ->where('status_id', $STATUS_CONCLUIDO)
            ->count();

        // TAREFAS ATRASADAS
        $atrasadas = DB::table('tabela_item')
            ->where('user_id', $userId)
            ->where(function ($query) use ($STATUS_ATRASADA, $STATUS_CONCLUIDO, $hoje) {
                $query->where('status_id', $STATUS_ATRASADA)
                    ->orWhere(function ($subQuery) use ($STATUS_CONCLUIDO, $hoje) {
                        $subQuery->where('status_id', '!=', $STATUS_CONCLUIDO)
                            ->where('prazo', '<', $hoje);
                    });
            })
            ->count();

        return view('dashboard', compact('total', 'pendentes', 'concluidas', 'atrasadas'));
    }



    /**
     * API: Listar todas as tarefas
     */
    public function indexApi()
    {
        $tarefas = ListModel::all();
        return response()->json([
            'success' => true,
            'count' => $tarefas->count(),
            'data' => $tarefas
        ], 200);
    }

    /**
     * API: Criar nova tarefa
     */
    public function storeApi(Request $request)
    {
        try {
            $tarefas = new ListModel();

            $tarefas->tituloTarefa = $request->tituloTarefa;
            $tarefas->dataCriacao  = $request->dataCriacao;
            $tarefas->prazo        = $request->prazo;
            $tarefas->status_id    = $request->status_id;
            $tarefas->user_id      = Auth::id() ?? $request->user_id ?? 1;

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

    /**
     * Web: Criar nova tarefa
     */
    public function store(Request $request)
    {
        $request->validate([
            'tituloTarefa' => 'required',
            'dataCriacao' => 'required',
            'prazo' => 'required',
            'status_id' => 'required',
        ]);

        DB::table('tabela_item')->insert([
            'tituloTarefa' => $request->tituloTarefa,
            'dataCriacao' => $request->dataCriacao,
            'prazo' => $request->prazo,
            'status_id' => $request->status_id,
            'user_id' => Auth::id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back();
    }

    /**
     * Web: Deletar tarefa
     */
    public function destroy($id)
    {
        DB::table('tabela_item')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->delete();

        return redirect()->back();
    }

    /**
     * API: Deletar tarefa
     */
    public function destroyApi($id)
    {
        $tarefas = ListModel::findOrFail($id);
        $tarefas->delete();

        return response()->json([
            'success' => true,
            'message' => 'Task deleted successfully'
        ], 200);
    }

    /**
     * Web: Ver status das tarefas
     */
    public function indexStatus()
    {
        $tarefasComStatus = DB::table('tabela_item')
            ->join('status', 'tabela_item.status_id', '=', 'status.id')
            ->where('tabela_item.user_id', Auth::id())
            ->select('tabela_item.*', 'status.valor')
            ->get();

        return view('status', compact('tarefasComStatus'));
    }

    public static function countTarefas()
    {
        // Conta as tarefas do usuário logado
        return \Illuminate\Support\Facades\DB::table('tabela_item')
            ->where('user_id', \Illuminate\Support\Facades\Auth::id())
            ->count();
    }



    /**
     * API: Atualizar tarefa
     */
    public function updateApi(Request $request, string $id)
    {
        $tarefas = ListModel::findOrFail($id);
        $tarefas->tituloTarefa = $request->tituloTarefa ?? $tarefas->tituloTarefa;
        $tarefas->dataCriacao = $request->dataCriacao ?? $tarefas->dataCriacao;
        $tarefas->prazo = $request->prazo ?? $tarefas->prazo;
        $tarefas->status_id = $request->status_id ?? $tarefas->status_id;
        $tarefas->save();

        return response()->json([
            "success" => true,
            "message" => 'Task updated successfully',
            'data' => $tarefas
        ], 200);
    }

    /**
     * Web: Atualizar tarefa
     */
    public function update(Request $request, $id)
    {
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
