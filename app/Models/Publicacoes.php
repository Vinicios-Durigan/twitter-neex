<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacoes extends Model
{
    use HasFactory;

    protected $fillable = [
        'texto_publicacao',
        'user_id',
    ];
}
