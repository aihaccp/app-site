<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Company extends Model
{
    use HasFactory;
    protected $table = "companies";
    protected $fillable = [
        'name',
        'morada',
        'cp',
        'localidade',
        'titulo_licenciamento',
        'n_funcionarios',
        'tipo_estabelecimento',
        'n_users',
        'cae',
        // Adicione outros campos que você deseja que sejam atribuíveis em massa
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
    }
    public function organition()
    {
        return $this->belongsTo(Organition::class);
    }
    public function fornecedores()
    {
        return $this->belongsToMany(Fornecedores::class, 'company_fornecedores');
    }
}
