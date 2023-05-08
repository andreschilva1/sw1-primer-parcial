<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Evento;
class EventosApiController extends Controller
{
    
    public function eventosGet()
    {
        $eventos = Evento::all();
        return $eventos;
    }
}
