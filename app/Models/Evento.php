<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $table = 'eventos';
    protected $fillable = [
        'nombre',
        'descripcion',
        'direccion',
        'fecha',
        'hora',
        'ubicacion',
        'photo_path',
        'organizadores_id',
    ];

    public function organizador()
    {
        return $this->belongsTo(Organizador::class);
    }

    public function solicitudClienteOrganizador()
    {
        return $this->hasOne(SolicitudClienteOrganizador::class);
    }

   


    public function existeSolicitud($eventid) {
        
        if(auth()->user()->tipo == 'Fotografo'){
            
            $solicitud = SolicitudFotografoOrganizador::select('solicitud_fotografo_organizadores.*')
            ->where('eventos_id',$eventid)->where('fotografos_id',auth()->user()->fotografo->id)->first();

        }elseif (auth()->user()->tipo == 'Cliente') {

            $solicitud = SolicitudClienteOrganizador::select('solicitud_cliente_organizadores.*')
            ->where('eventos_id',$eventid)->where('clientes_id',auth()->user()->cliente->id)->first();
        }
        //dd($solicitudCliente);
        return  ($solicitud == null ?false : true);
             
    }
}
