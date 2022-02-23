<?php

namespace App\Services;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmpresaService
{
    public static function create(Request $request)
    {
        $validator = Validator::make( $request->toArray(), [
            'numero_identificacao' => 'required|unique:empresas',
            'email'                => 'required|email|unique:empresas',
            'nome_fantasia'        => 'required|max:255',
            'nome_responsavel'     => 'required|max:255',
            'telefone'             => 'required|max:100',
            'codigo_postal'        => 'required|max:50',
            'numero'               => 'required|max:255',
            'rua'                  => 'required|max:100',
            'bairro'               => 'required|max:100',
            'cidade'               => 'required|max:100',
            'estado'               => 'required|max:100',
            'pais'                 => 'required|max:50'
        ], [
            'required' => 'O campo :attribute é obrigatório.',
            'unique'   => 'O atributo :attribute já foi cadastrado.',
            'email'    => 'O :attribute deve ser um endereço válido.',
            'max'      => 'O :attribute não pode ser maior que :max caractere.'
        ] );

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        return Empresa::create( $request->only( [
            'numero_identificacao',
            'email',
            'nome_fantasia',
            'nome_responsavel',
            'telefone',
            'codigo_postal',
            'numero',
            'rua',
            'bairro',
            'cidade',
            'estado',
            'pais'
        ] ) );
    }

    public static function update(Request $request, $id)
    {
        $validator = Validator::make( $request->toArray(), [
            'numero_identificacao' => 'required|unique:empresas',
            'email'                => 'required|email|unique:empresas',
            'nome_fantasia'        => 'required|max:255',
            'nome_responsavel'     => 'required|max:255',
            'telefone'             => 'required|max:100',
            'codigo_postal'        => 'required|max:50',
            'numero'               => 'required|max:255',
            'rua'                  => 'required|max:100',
            'bairro'               => 'required|max:100',
            'cidade'               => 'required|max:100',
            'estado'               => 'required|max:100',
            'pais'                 => 'required|max:50'
        ], [
            'required' => 'O campo :attribute é obrigatório.',
            'unique'   => 'O atributo :attribute já foi cadastrado.',
            'email'    => 'O :attribute deve ser um endereço válido.',
            'max'      => 'O :attribute não pode ser maior que :max caractere.'
        ] );

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        return Empresa::updateOrCreate( ['id' => $id], $request->only( [
            'numero_identificacao',
            'email',
            'nome_fantasia',
            'nome_responsavel',
            'telefone',
            'codigo_postal',
            'numero',
            'rua',
            'bairro',
            'cidade',
            'estado',
            'pais'
        ] ) );
    }

    public static function show($id)
    {
        $result = Empresa::where('id', $id)->orWhere('numero_identificacao', 'like', "%$id%")->get()->first();
        if (empty($result)) {
            return response()->json(['status' => 'error', 'message' => 'Empresa não encontrada!']);
        }
        return $result;
    }
}
