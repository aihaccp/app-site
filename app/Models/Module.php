<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Module extends Model
{
    use HasFactory;

    protected $table = 'modules';

    public function folders(){
        return $this->hasMany(Folder::class);
    }

}
