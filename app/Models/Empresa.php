<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = [
        "numero_identificacao",
        "email",
        "nome_fantasia",
        "nome_responsavel",
        "telefone",
        "codigo_postal",
        "numero",
        "rua",
        "bairro",
        "cidade",
        "estado",
        "pais",
        "status",
    ];

    protected $guarded = ['id'];
}
