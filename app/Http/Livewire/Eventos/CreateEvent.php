<?php

namespace App\Http\Livewire\Eventos;

use App\Models\Fotografo;
use App\Models\Organizador;
use App\Models\Cliente;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Evento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;


class CreateEvent extends Component
{
    use WithFileUploads;

    public $titulo, $descripcion, $direccion, $fecha, $hora, $ubicacion, $foto,$identificador;
    public $searchFotografo, $searchCliente;
    public $open = false; 
    public $solicitudes;

    

    public function render()
    {
        

        $fotografos  = Fotografo::join('users','users.id', 'fotografos.user_id')->where('users.name','like','%'. $this->searchFotografo .'%')
        ->orWhere('users.email','like','%'. $this->searchFotografo .'%')->get();

        $clientes = Cliente::join('users','users.id', 'clientes.user_id')->where('users.name','like','%'. $this->searchCliente .'%')
        ->orWhere('users.email','like','%'. $this->searchCliente .'%')->get();

        return view('livewire.eventos.create-event', compact( 'fotografos', 'clientes'));
    }

    protected $rules = [
        'titulo' => 'required|max:25',
        'descripcion' => 'max:50',
        'direccion' => 'required|max:30',
        'fecha' => 'required|date',
        'hora' => 'required|date_format:H:i'
    ];

    public function mount()
    {
        $this->identificador = rand();
    }
    
    public function updatedOpen()
    {
        if ($this->open == true) {
            $this->reset(['titulo','descripcion','direccion','fecha','hora','foto','searchFotografo','searchCliente']);
            $this->identificador = rand();
        }
    }
    
       
    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->solicitudes = new Collection();
        $eventos = Evento::all();

        foreach ($eventos  as $evento) {
           $this->solicitudes->push($evento);
        }
        dd($this->solicitudes);

        $this->validate();
        $alerta = [];
        $evento = new Evento();

        $foto = null;
        
        if ($this->foto) {
            
            $foto = $this->foto->store('eventos');
        }

        

        $evento->nombre = $this->titulo;
        $evento->descripcion = $this->descripcion;
        $evento->direccion = $this->direccion;
        $evento->fecha = $this->fecha;
        $evento->hora = $this->hora;
        $evento->ubicacion = $this->ubicacion;
        $evento->photo_path = $foto;
     
        $evento->organizadores_id = Auth::user()->organizador->id;
        
        $evento->save();
        
        
        
        $alerta = ['mensaje' => 'El evento se creo satisfactoriamente','icono'=>'success'];
        
        $this->reset(['titulo','descripcion','direccion','fecha','hora','foto','searchFotografo','searchCliente']);
        $this->emitTo('Eventos.show-events','render');
        $this->emit('alert',$alerta);
        $this->open = !$this->open;
        
    }
}
