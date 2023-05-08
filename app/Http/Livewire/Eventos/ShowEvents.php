<?php

namespace App\Http\Livewire\Eventos;

use Livewire\Component;
use App\Models\Evento;
use App\Models\Fotografo;
use App\Models\Cliente;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Collection;
use App\Models\SolicitudClienteOrganizador;
use App\Models\SolicitudFotografoOrganizador;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ShowEvents extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search;
    public $count = 8;

    public $listeners = ['render','delete'];

    public function render()
    {

        $eventos = Evento::where('nombre', 'like', '%' . $this->search . '%')
            ->orWhere('descripcion', 'like', '%' . $this->search . '%')
            ->orwhere('direccion', 'like', '%' . $this->search . '%')->orderBy('id', 'desc')->paginate($this->count);

        return view('livewire.eventos.show-events', compact('eventos'));
    }


    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCount()
    {
        $this->resetPage();
    }


    public function delete(Evento $event) {

        if ($event->photo_path) {
            Storage::delete($event->photo_path);
        }

        $event->delete();
    }

}
