<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FolderPrerequisito extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'icon','disabled'];

    public function files()
    {
        return $this->hasMany(FilePrerequisito::class);
    }
}
