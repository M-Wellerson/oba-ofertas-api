<?php

namespace App\Services;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriaService
{
    public static function create(Request $request)
    {
        $validator = Validator::make($request->toArray(), [
            'nome'      => 'required|max:255',
            'descricao' => 'required|max:255',
            'slug'      => 'required|unique:categorias',
        ], [
            'required' => 'O campo :attribute é obrigatório.',
            'unique'   => 'O atributo :attribute já foi cadastrado.'
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        return Categoria::create($request->only([
            'nome',
            'descricao',
            'slug'
        ]));
    }

    public static function update(Request $request, $id)
    {
        $validator = Validator::make($request->toArray(), [
            'nome'      => 'required|max:255',
            'descricao' => 'required|max:255',
            'slug'      => 'required',
        ], [
            'required' => 'O campo :attribute é obrigatório.',
            'unique'   => 'O atributo :attribute já foi cadastrado.'
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        return Categoria::updateOrCreate(['id' => $id], $request->only([
            'nome',
            'descricao',
            'slug'
        ]));
    }

    public static function show($id)
    {
        $result = Categoria::where('id', $id)->orWhere('slug', 'like', "%$id%")->get()->first();
        if (empty($result)) {
            return response()->json(['status' => 'error', 'message' => 'Categoria não encontrada!']);
        }
        return $result;
    }
}
