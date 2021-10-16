<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_provider',
        'nama_provider',
        'jenis_provider',
        'file',
        'tanggal',
    ];

    // protected $guarded = [];
}
