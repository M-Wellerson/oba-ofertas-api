<?php

namespace App\Services;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsuarioService
{
    public static function create(Request $request)
    {
        $validator = Validator::make($request->toArray(), [
            'email'    => 'required|string|max:255',
            'nome'     => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'foto'     => 'string',
        ], [
            'required' => 'O campo :attribute é obrigatório.',
            'unique'   => 'O atributo :attribute já foi cadastrado.'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        return Usuario::create([ 
            'email'    => $request->email,
            'nome'     => $request->nome,
            'password' => app('hash')->make($request->password),
            'foto'     => $request->foto 
        ]);
    }

    public static function update(Request $request, $id)
    {
        $validator = Validator::make($request->toArray(), [
            'nome'  => 'required|max:255',
            'email' => 'required|max:255',
            'foto'  => 'required',
        ], [
            'required' => 'O campo :attribute é obrigatório.',
            'unique'   => 'O atributo :attribute já foi cadastrado.'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        return Usuario::updateOrCreate(['id' => $id], $request->only([
            'nome',
            'email',
            'foto'
        ]));
    }

    public static function show($id)
    {
        $result = Usuario::where('id', $id)->orWhere('email', 'like', "%$id%")->get()->first();
        if (empty($result)) {
            return response()->json(['status' => 'error', 'message' => 'Usuário não encontrada!']);
        }
        return $result;
    }
}
