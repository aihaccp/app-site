<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\File;
use App\Models\Module;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Folder extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug','module_id','id_company'];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
    public function files()
    {
        return $this->hasMany(File::class);
    }

}
