<?php

namespace App\Http\Livewire\Eventos;

use Livewire\Component;
use App\Models\Evento;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class ShowEvents extends Component
{
use WithPagination;
use WithFileUploads;

public $search, $nombre, $descripcion, $direccion, $fecha, $hora, $ubicacion, $foto;
public $count = 8;

public $listeners = ['render'];
    

    public function render()
    {
        $eventos2 = Evento::all();
        $eventos = Evento::where('nombre','like','%'. $this->search .'%')
        ->orWhere('descripcion','like','%'. $this->search .'%')
        ->orwhere('direccion','like','%'. $this->search .'%')->orderBy('id','desc')->paginate($this->count);

        return view('livewire.eventos.show-events', compact('eventos'));
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function updatingCount(){
        $this->resetPage();
    }
}
