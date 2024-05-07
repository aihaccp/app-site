<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilePrerequisito extends Model
{
    use HasFactory;
    protected $table = 'files_prerequisitos';
    protected $fillable = ['name', 'folder_id','avatar','id_company'];

    public function folder()
    {
        return $this->belongsTo(FolderPrerequisito::class);
    }
}
