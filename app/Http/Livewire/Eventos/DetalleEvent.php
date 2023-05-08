<?php

namespace App\Http\Livewire\Eventos;

use Livewire\Component;
use App\Models\Evento;
use App\Models\Fotografia;

class DetalleEvent extends Component
{
    public $evento;
    public function render()
    {
        $fotos = Fotografia::join('cliente_fotografias', 'fotografias.id', '=', 'cliente_fotografias.fotografias_id')
        ->select('fotografias.*')
        ->where('cliente_fotografias.cliente_id', auth()->user()->cliente->id)
        ->where('fotografias.eventos_id', $this->evento->id)->get();
        return view('livewire.eventos.detalle-event', compact('fotos'));
    }

    public function mount(Evento $id)
    {
        $this->evento = $id;
        //dd($this->evento);
    }
}
