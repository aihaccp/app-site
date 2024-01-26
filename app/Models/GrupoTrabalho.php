<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoTrabalho extends Model
{
    use HasFactory;
    protected $fillable = ['nome_cargo', 'name_resp','name_outsourcing'];
    protected $table = 'responsavel_user_out';
}
