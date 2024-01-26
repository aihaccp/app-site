<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantaCompany extends Model
{
    protected $fillable = ['id_empresa','name', 'avatar','tipo'];
    use HasFactory;
    protected $table = 'planta_companies';
}
