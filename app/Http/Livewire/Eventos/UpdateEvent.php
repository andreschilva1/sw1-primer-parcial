<?php

namespace App\Http\Livewire\Eventos;

use Livewire\Component;
use App\Models\Evento;
use App\Models\Fotografo;
use App\Models\Cliente;
use Livewire\WithFileUploads;
use Illuminate\Support\Collection;
use App\Models\SolicitudClienteOrganizador;
use App\Models\SolicitudFotografoOrganizador;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UpdateEvent extends Component
{
    use WithFileUploads;
    public $evento, $foto, $identificador, $searchFotografo, $searchCliente;
    public $openEdit = false;
    public $solicitudesFotografos;
    public $solicitudesClientes;
    protected $listeners = ['edit','enlistarSolicitudFotografo', 'enlistarSolicitudCliente'];

    public function render()
    {
        
        $fotografos  = Fotografo::join('users', 'users.id', 'fotografos.user_id')->select('fotografos.*')->where('users.name', 'like', '%' . $this->searchFotografo . '%')
            ->orWhere('users.email', 'like', '%' . $this->searchFotografo . '%')->get();

        $clientes = Cliente::join('users', 'users.id', 'clientes.user_id')->select('clientes.*')->where('users.name', 'like', '%' . $this->searchCliente . '%')
            ->orWhere('users.email', 'like', '%' . $this->searchCliente . '%')->get();

        return view('livewire.eventos.update-event',compact( 'fotografos', 'clientes'));
    }

    protected $rules = [
        'evento.nombre' => 'required|max:35',
        'evento.descripcion' => 'max:200',
        'evento.direccion' => 'required|max:50',
        'evento.fecha' => 'required|date',
        'evento.hora' => 'required',
        
    ];

    public function mount()
    {
        $this->evento = new Evento();
        $this->solicitudesFotografos = new Collection();
        $this->solicitudesClientes = new Collection();
       
    }

    public function updatedOpenEdit()
    {
        if ($this->openEdit == false) {
            $this->reset(['foto', 'searchFotografo', 'searchCliente', 'solicitudesFotografos', 'solicitudesClientes']);
            $this->solicitudesFotografos = new Collection();
            $this->solicitudesClientes = new Collection();
            $this->identificador = rand();
        }
    }

    public function enlistarSolicitudFotografo($fotografoId)
    {
        if ($this->solicitudesFotografos->contains('fotografo_id', $fotografoId)) {
            $this->solicitudesFotografos = $this->solicitudesFotografos->reject(function ($elemento) use ($fotografoId) {
                return $elemento['fotografo_id'] === $fotografoId;
            });
        } else {
            $solocitud = [
                'fotografo_id' => $fotografoId,
            ];

            $this->solicitudesFotografos->push($solocitud);
        }
    }

    public function enlistarSolicitudCliente($clienteId)
    {

        if ($this->solicitudesClientes->contains('cliente_id', $clienteId)) {
            $this->solicitudesClientes = $this->solicitudesClientes->reject(function ($elemento) use ($clienteId) {
                return $elemento['cliente_id'] === $clienteId;
            });
        } else {
            $solocitud = [
                'cliente_id' => $clienteId,
            ];

            $this->solicitudesClientes->push($solocitud);
        }
    }

    public function edit(Evento $evento)
    {
        $this->evento = $evento;
        //dd($this->evento);
        $this->openEdit = !$this->openEdit;
    }

    public function update()
    {
        $this->validate();
       
        if ($this->foto) {
            
            if ($this->evento->photo_path) {
                
                Storage::delete($this->evento->photo_path);
            }

            $nombre = $this->foto->getClientOriginalName();
            $ruta = $this->foto->storeAs('public/eventos/',$nombre);
            $url = Storage::url($ruta);
            $this->evento->photo_path = $url;

        }

        $this->evento->save();
        foreach ($this->solicitudesFotografos as $solicitudfotografo) {

            SolicitudFotografoOrganizador::create([

                'emisor' => Auth::user()->organizador->id,
                'receptor' => $solicitudfotografo['fotografo_id'],
                'estado' => 'pendiente',
                'organizadores_id' => Auth::user()->organizador->id,
                'fotografos_id' => $solicitudfotografo['fotografo_id'],
                'eventos_id' => $this->evento->id,
            ]);
        }

        foreach ($this->solicitudesClientes as $solicitudCliente) {

            SolicitudClienteOrganizador::create([

                'emisor' => Auth::user()->organizador->id,
                'receptor' => $solicitudCliente['cliente_id'],
                'estado' => 'pendiente',
                'organizadores_id' => Auth::user()->organizador->id,
                'clientes_id' => $solicitudCliente['cliente_id'],
                'eventos_id' => $this->evento->id,
            ]);
        }


        $this->reset(['foto', 'searchFotografo', 'searchCliente', 'solicitudesFotografos', 'solicitudesClientes']);
        $this->solicitudesFotografos = new Collection();
        $this->solicitudesClientes = new Collection();
        $this->emitTo('eventos.show-events','render' );
        $this->emit('alert', ['mensaje' => 'El evento se actualizo satisfactoriamente', 'icono' => 'success']);
        $this->openEdit = !$this->openEdit;
    }
}
