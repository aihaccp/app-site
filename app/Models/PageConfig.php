<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageConfig extends Model
{
    use HasFactory;
    protected $table = 'page_configs';

    // Defina as colunas que podem ser preenchidas em massa
    protected $fillable = ['module_slug', 'folder_slug', 'view_path', 'title'];

}
