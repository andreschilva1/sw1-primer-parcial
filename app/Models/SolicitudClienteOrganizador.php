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
        return $this->belongsTo(Cliente::class, 'clientes_id', 'id');
    }

    public function evento()
    {
        return $this->belongsTo(Evento::class, 'eventos_id', 'id');
    }

    public static function existeSolicitud( $eventid) {
        //dd($eventid);
        $solicitudCliente = SolicitudClienteOrganizador::select('solicitud_cliente_organizadores.*')->where('eventos_id',$eventid)->where('clientes_id',auth()->user()->cliente->id)->first();
        return  $solicitudCliente ;
             
    }

}

