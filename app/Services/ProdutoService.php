<?php

namespace App\Services;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdutoService
{
    public static function create(Request $request)
    {
        $validator = Validator::make($request->toArray(), [
            'nome'         => 'required|max:255',
            'descricao'    => 'required|max:255',
            'preco'        => 'required',
            'status'       => 'required',
            'tipo_entrega' => 'required|json',
            'imagens'      => 'required|json',
            'categorias'   => 'required|json',
            'empresa_id'   => 'required',
        ], [
            'required' => 'O campo :attribute é obrigatório.',
            'unique'   => 'O atributo :attribute já foi cadastrado.',
            'json'     => 'Formato não é JSON!'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $post = new Produto();
        $post->empresa_id   = $request->empresa_id;
        $post->nome         = $request->nome;
        $post->descricao    = $request->descricao;
        $post->preco        = $request->preco;
        $post->status       = $request->status;
        $post->tipo_entrega = $request->tipo_entrega;
        $post->imagens      = $request->imagens;
        $post->categorias   = $request->categorias;

        $post->save();

        return response()->json(['status' => 'success', 'message' => 'Criado com sucesso!']);
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
            return response()->json($validator->errors(), 400);
        }

        Produto::updateOrCreate(['id' => $id], $request->only([
            'nome',
            'descricao',
            'slug'
        ]));

        return response()->json(['status' => 'success', 'message' => 'Atualizado com sucesso!']);
    }

    public static function show($id)
    {
        $result = Produto::where('id', $id)->get()->first();
        if (empty($result)) {
            return response()->json(['status' => 'error', 'message' => 'Produto não encontrada!']);
        }
        return $result;
    }

    public static function GetByEmpresaID($id)
    {
        $result = Produto::where('empresa_id', $id)->get()->first();
        if (empty($result)) {
            return response()->json(['status' => 'error', 'message' => 'Produto não encontrada!']);
        }
        return $result;
    }
}
