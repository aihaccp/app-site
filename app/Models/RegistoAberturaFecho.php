<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistoAberturaFecho extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_empresa', 'id_abertura_fecho', 'id_user','id_use',
    ];    protected $table = "registo_abertura_fecho";
}
