<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $fillable = [
        'user_id',
        'foto1',
        'foto2',
        'foto3',
    ];

    

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /* public function eventos()
    {
        return $this->hasMany(Evento::class, 'cliente_id', 'id');
    } */

}
