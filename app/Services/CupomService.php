<?php

namespace App\Services;

use App\Models\Cupom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CupomService
{
    public static function create(Request $request)
    {
        $validator = Validator::make($request->toArray(), [
            'empresas_id' => 'required|max:255',
            'regulamento' => 'required|max:255',
            'descricao'   => 'required|max:255',
            'desconto'    => 'required|max:255',
            'quantidade'  => 'required|max:255',
            'periodo'     => 'required',
        ], [
            'required' => 'O campo :attribute é obrigatório.',
            'unique'   => 'O atributo :attribute já foi cadastrado.'
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        return Cupom::create($request->only([
            'empresas_id',
            'regulamento',
            'descricao',
            'desconto',
            'quantidade',
            'periodo'
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

        return Cupom::updateOrCreate(['id' => $id], $request->only([
            'nome',
            'descricao',
            'slug'
        ]));
    }

    public static function show($id)
    {
        $result = Cupom::where('id', $id)->orWhere('slug', 'like', "%$id%")->get()->first();
        if (empty($result)) {
            return response()->json(['status' => 'error', 'message' => 'Cupom não encontrado!']);
        }
        return $result;
    }
}
