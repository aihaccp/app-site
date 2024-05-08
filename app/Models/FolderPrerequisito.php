<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FolderPrerequisito extends Model
{
    use HasFactory;
    protected $table = 'folder_prerequisitos';
    protected $fillable = ['name', 'slug', 'icon','disabled', 'text'];

    public function company()
{
    return $this->belongsTo(Company::class);
}
    public function files()
    {
        return $this->hasMany(FilePrerequisito::class);
    }
}
