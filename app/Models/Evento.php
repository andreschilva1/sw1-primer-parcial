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
}
