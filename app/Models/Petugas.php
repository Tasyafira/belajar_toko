<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    protected $table = 'petugas';
    public $timestamps = false;

    protected $fillable = ['nama_petugas', 'username', 'password', 'level'];
    
    use HasFactory;
}
