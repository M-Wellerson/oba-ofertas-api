<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cupom extends Model
{
    use HasFactory;

    protected $rules = [];

    protected $table = 'cupons';

    protected $fillable = [
        "empresas_id",
        "descricao",
        "regulamento",
        "quantidade",
        "periodo",
        "status",
        "desconto",
    ];

    protected $guarded = ['id'];
}
