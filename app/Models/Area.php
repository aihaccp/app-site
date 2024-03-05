<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Area extends Model
{
    use HasFactory;

    protected $table = 'area';
    protected $fillable = ['designacao', 'id_empresa'];
    public static function boot(){
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
    }
    public function equipments()
    {
        return $this->hasMany(Equipamento::class, 'id_area');
    }
}
