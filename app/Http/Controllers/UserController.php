<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

/**
 * controlador para cadastro de usuários (register e login).
 */
class UserController extends Controller 
{
    /**
     * registra um novo usuário.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        // Cria um novo usuário com os dados fornecidos na requisição.
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Gera um token JWT para o novo usuário.
        $token = JWTAuth::fromUser($user);

        // Retorna a resposta em JSON com os dados do usuário e o token, e o status 201 (created).
        return response()->json(compact('user', 'token'), 201);
    }

    /**
     * função para login do usuário.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // pegando os campos 'email' e 'password' da requisição.
        $credentials = $request->only('email', 'password');

        try {
            // tenta autenticar o usuário com as credenciais fornecidas
            if (! $token = JWTAuth::attempt($credentials)) {
                // se a autenticação falhar, retorna uma resposta com erro e status 401 (unauthorized)
                return response()->json(['error' => 'Credenciais Inválidas!'], 401);
            }
        } catch (JWTException $e) {
            // se ocorrer um erro ao criar o token, retorna uma resposta com erro e status 500 (internal server error)
            return response()->json(['error' => 'Erro ao criar Token'], 500);
        }

        // se a autenticação for bem-sucedida, retorna o token
        return response()->json(compact('token'));
    }
}