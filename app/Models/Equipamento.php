<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Equipamento extends Model
{
    use HasFactory;

    protected $table = 'equipamento';
    protected $fillable = [
        'nome',
        'temp_max',
        'temp_min',
        'id_empresa',
        'tipo',
        'id_area'
        // Adicione outros campos que você deseja que sejam atribuíveis em massa
    ];

    public static function boot(){
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
    }
}
