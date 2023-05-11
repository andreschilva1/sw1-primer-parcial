<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventoFotografo extends Model
{
    use HasFactory;
    protected $table = 'evento_fotografos';

    protected $fillable = [
        'eventos_id',
        'fotografos_id',
    ];

    public function fotografo()
    {
        return $this->belongsTo(fotografo::class, 'fotografos_id', 'id');
    }
}
