<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Auditoria extends Model
{
    use HasFactory;
    protected $table = 'auditorias';
    protected $fillable = ['uuid', 'id_empresa', 'name', 'id_frequencia'];
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
    }
    public function perguntas()
    {
        return $this->hasMany(AuditoriaPergunta::class, 'id_auditoria');
    }
    public function frequencia()
    {
        return $this->belongsTo(Frequencia::class, 'id_frequencia');
    }
}
