<?php

namespace App\Services;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminService
{
    public static function create(Request $request)
    {
        $validator = Validator::make($request->toArray(), [
            'email'    => 'required|string|max:255|unique:admins',
            'nome'     => 'required|string|max:255',
            'password' => 'required|string|max:100',
            'nivel'    => 'required|string|max:status',
            'status'   => 'required',
        ], [
            'required' => 'O campo :attribute é obrigatório.',
            'unique'   => 'O atributo :attribute já foi cadastrado.',
            'email'    => 'O :attribute deve ser um endereço válido.',
            'max'      => 'O :attribute não pode ser maior que :max caractere.'
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        return Admin::create([
            'email'    => $request->email,
            'nome'     => $request->nome,
            'password' => app('hash')->make($request->password),
            'nivel'    => $request->nivel,
            'status'   => $request->status
        ]);
    }

    public static function update(Request $request, $id)
    {
        $validator = Validator::make($request->toArray(), [
            'email'    => 'required|string|max:255',
            'nome'     => 'required|string|max:255',
            'nivel'    => 'required|string|max:status',
            'status'   => 'required',
        ], [
            'required' => 'O campo :attribute é obrigatório.',
            'unique'   => 'O atributo :attribute já foi cadastrado.',
            'email'    => 'O :attribute deve ser um endereço válido.',
            'max'      => 'O :attribute não pode ser maior que :max caractere.'
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        return Admin::updateOrCreate(['id' => $id], $request->only([
            'nome',
            'email',
            'nivel',
            'status'
        ]));
    }

    public static function show($id)
    {
        $result = Admin::where('id', $id)->orWhere('email', 'like', "%$id%")->get()->first();
        if (empty($result)) {
            return response()->json(['status' => 'error', 'message' => 'Usuário não encontrada!']);
        }
        return $result;
    }

    public static function login($info)
    {
        $validator = Validator::make($info, [
            'email'    => 'required|string',
            'password' => 'required|string',
        ], [
            'required' => 'O campo :attribute é obrigatório.',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        if (!$token = auth('dashboard')->attempt($info)) {
            return response()->json(['mensagem' => 'E-mail ou senha incorretos'], 401);
        }

        return self::respondWithToken($token);
    }

    protected static function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => Auth::factory()->getTTL() * 60
        ]);
    }
}
