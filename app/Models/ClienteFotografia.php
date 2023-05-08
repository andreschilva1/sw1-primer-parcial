<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteFotografia extends Model
{
    use HasFactory;
    protected $table = 'cliente_fotografias';

    protected $fillable = [
        'cliente_id',
        'fotografias_id',
    ];
}
