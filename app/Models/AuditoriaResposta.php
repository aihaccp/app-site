<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class AuditoriaResposta extends Model
{
    use HasFactory;
    protected $fillable = ['id_pergunta', 'id_auditoria', 'id_user', 'resposta', 'block'];

    public function pergunta()
    {
        return $this->belongsTo(AuditoriaPergunta::class, 'id_pergunta');
    }

    public function auditoria()
    {
        return $this->belongsTo(Auditoria::class, 'id_auditoria');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
