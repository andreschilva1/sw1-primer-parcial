<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventoCliente extends Model
{
    use HasFactory;
    protected $table = 'evento_clientes';

    protected $fillable = [
        'eventos_id',
        'clientes_id',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'clientes_id', 'id');
    }
}
