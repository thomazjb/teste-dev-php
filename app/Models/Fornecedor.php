<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fornecedor extends Model
{
    use HasFactory; 

    protected $table = 'fornecedores'; 

    protected $fillable = [
        'razao_social',
        'cnpj',
        'nome_fantasia',
        'email',
        'telefone',
    ];

    protected $casts = [
        'cnpj' => 'string', 
    ];
}

