<?php



namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CadastroController extends Controller
{
    public function store(Request $request)
    {
        try {
            $user = User::create([
                'nome'   => $request->nome,
                'email'  => $request->email,
                'altura' => $request->altura,
                'peso'   => $request->peso,
                'senha'  => Hash::make($request->senha),
            ]);

            return response()->json(['message' => 'Cadastrado com sucesso!', 'user' => $user], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao cadastrar: ' . $e->getMessage()], 400);
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'senha' => 'required'
        ]);
    
        // Busca o usuário pelo e-mail na tbusuario
        $user = User::where('email', $request->email)->first();
    
        // Verifica se usuário existe e se a senha bate com o Hash neeeee
        if (!$user || !Hash::check($request->senha, $user->senha)) {
            return response()->json(['error' => 'Credenciais inválidas'], 401);
        }
    
        return response()->json([
            'message' => 'Login realizado!',
            'user' => $user
        ], 200);
    }
    
}

