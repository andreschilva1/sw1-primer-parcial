<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudFotografoOrganizador extends Model
{
    use HasFactory;
    protected $table = 'solicitud_fotografo_organizadores';
    
    protected $fillable = [
        'emisor',
        'receptor',
        'estado',
        'organizadores_id',
        'fotografos_id',
        'eventos_id',

        
    ];

    public function organizador()
    {
        return $this->belongsTo(Organizador::class);
    }

    public function fotografo()
    {
        return $this->belongsTo(Fotografo::class);
    }

    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }
}
