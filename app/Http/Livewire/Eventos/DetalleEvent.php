<?php

namespace App\Http\Livewire\Eventos;

use Livewire\Component;
use App\Models\Evento;
use App\Models\EventoCliente;
use App\Models\EventoFotografo;
use App\Models\Fotografia;
use App\Models\SolicitudClienteOrganizador;
use App\Models\SolicitudFotografoOrganizador;

class DetalleEvent extends Component
{
    public $evento;
    protected $listeners = ['solicitudCliente','solicitudFotografo'];

    public function render()
    {
        $solicitudesClientes = SolicitudClienteOrganizador::where('estado', 'pendiente')->where('eventos_id', $this->evento->id)->get();
        $solicitudesFotografos = SolicitudFotografoOrganizador::where('estado', 'pendiente')->where('eventos_id', $this->evento->id)->get();        
        //dd($solicitudesFotografos->fotografo->user->name);


        $invitados = EventoCliente::where('eventos_id', $this->evento->id)->get();
        $fotografos = EventoFotografo::where('eventos_id', $this->evento->id)->get();
        //dd($invitados);
        
        //dd($solicitudesFotografos);

        $fotos = null;

        if (auth()->user()->cliente) {
            $fotos = Fotografia::join('cliente_fotografias', 'fotografias.id', '=', 'cliente_fotografias.fotografias_id')
            ->select('fotografias.*')
            ->where('cliente_fotografias.cliente_id', auth()->user()->cliente->id)
            ->where('fotografias.eventos_id', $this->evento->id)->get();
        }
        return view('livewire.eventos.detalle-event', compact('fotos', 'solicitudesClientes', 'solicitudesFotografos', 'invitados', 'fotografos'));
    }

    public function mount(Evento $id)
    {
        $this->evento = $id;
        //dd($this->evento);
    }

    public function solicitudCliente(SolicitudClienteOrganizador $solicitud)
    {
        //dd($solicitud);
        $solicitud->update([
            'estado' => 'aceptado',
        ]);

        EventoCliente::create([
            'eventos_id' => $solicitud->eventos_id,
            'clientes_id' => $solicitud->clientes_id,
        ]);

    }

    public function solicitudFotografo(SolicitudFotografoOrganizador $solicitud)
    {
        //dd($solicitud);
        $solicitud->update([
            'estado' => 'aceptado',
        ]);

        EventoFotografo::create([
            'eventos_id' => $solicitud->eventos_id,
            'fotografos_id' => $solicitud->fotografos_id,
        ]);
    }

    
}
