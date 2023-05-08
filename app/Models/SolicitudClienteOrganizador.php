<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudClienteOrganizador extends Model
{
    use HasFactory;

    protected $table = 'solicitud_cliente_organizadores';
    
    protected $fillable = [
        'organizadores_id',
        'clientes_id',
        'eventos_id',
        'emisor',
        'receptor',
        'estado',
        
    ];

    public function organizador()
    {
        return $this->belongsTo(Organizador::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }

}

