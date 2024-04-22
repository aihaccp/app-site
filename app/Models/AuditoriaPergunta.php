<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditoriaPergunta extends Model
{
    use HasFactory;
    protected $table = 'auditoria_perguntas';
    protected $fillable = ['nome', 'tipo_pergunta','id_auditoria'];
    public function respostas()
    {
        return $this->hasMany(AuditoriaResposta::class, 'id_pergunta');
    }
    public function auditoria()
    {
        return $this->belongsTo(Auditoria::class, 'id_auditoria');
    }
}
