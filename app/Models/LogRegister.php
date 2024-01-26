<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class LogRegister extends Model
{
    use HasFactory;

    protected $table = "log_registers";
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
