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
use App\Models\User;

class ShowEvents extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search, $eventosUsuarioAuth;
    public $count = 8;
    public $filtro = 'Todos';

    public $listeners = ['render','delete','createSolicitud'];

    public function render()
    {
        if ($this->filtro == 'MisEventos') {
            # code...
            $usuarioActual = User::find(auth()->user()->id);
            if ($usuarioActual->tipo == 'Cliente') {
                $usuarioActual = $usuarioActual->cliente->id;
                $eventos = Evento::join('evento_clientes', 'eventos.id', '=', 'evento_clientes.eventos_id')
                ->select('eventos.*')->where('evento_clientes.clientes_id', $usuarioActual)
                ->orderBy('id', 'desc')->paginate($this->count);
            
            }elseif ($usuarioActual->tipo == 'Organizador') {
                $usuarioActual = $usuarioActual->organizador->id;
                $eventos = Evento::where('organizadores_id', $usuarioActual)
                ->orderBy('id', 'desc')->paginate($this->count);
    
            }elseif ($usuarioActual->tipo == 'Fotografo') {
                $usuarioActual = $usuarioActual->Fotografo->id;
                $eventos = Evento::join('evento_fotografos', 'eventos.id', '=', 'evento_fotografos.eventos_id')
                ->select('eventos.*')->where('evento_fotografos.fotografos_id', $usuarioActual)
                ->orderBy('id', 'desc')->paginate($this->count);                    
            }
        }elseif ($this->filtro == 'Todos') {
            # code...
            $eventos = Evento::where('nombre', 'like', '%' . $this->search . '%')
                ->orWhere('descripcion', 'like', '%' . $this->search . '%')
                ->orwhere('direccion', 'like', '%' . $this->search . '%')->orderBy('id', 'desc')->paginate($this->count);
        }
        

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
        //dd($event->id);
        if ($event->photo_path) {
            Storage::delete($event->photo_path);
        }

        $event->delete();
    }

    public function createSolicitud(Evento $event) {
        //dd($event);
        //dd(SolicitudClienteOrganizador::existeSolicitud($event->id));
        //dd(Auth::user()->cliente->id);

        if (auth()->user()->tipo == 'Fotografo') {
            SolicitudFotografoOrganizador::create([
                'emisor' => auth()->user()->fotografo->id,
                'receptor' => $event->organizadores_id,
                'fotografos_id' => auth()->user()->fotografo->id,
                'organizadores_id' => $event->organizadores_id,
                'eventos_id' => $event->id,
                'estado' => 'pendiente'
            ]);
        } elseif (auth()->user()->tipo == 'Cliente') {
            SolicitudClienteOrganizador::create([
                'emisor' => auth()->user()->cliente->id,
                'receptor' => $event->organizadores_id,
                'clientes_id' => auth()->user()->cliente->id,
                'organizadores_id' => $event->organizadores_id,
                'eventos_id' => $event->id,
                'estado' => 'pendiente'
            ]);
        
        }
    }

}
