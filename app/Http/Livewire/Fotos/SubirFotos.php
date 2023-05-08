<?php

namespace App\Http\Livewire\Fotos;

use App\Models\ClienteFotografia;
use Illuminate\Console\Scheduling\Event;
use Livewire\WithFileUploads;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use App\Models\Evento;
use App\Models\Fotografia;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Events\notificaciones\FotoGuardada;

class SubirFotos extends Component
{
    use WithFileUploads;
    
    public $foto, $evento;
    public $open = false;
    protected $listeners = ["notiAparecesFoto", "motrarSubirFoto"];

    public function render()
    {
        return view('livewire.fotos.subir-fotos');
    }

   /*  public function mount(Evento $id)
    {
        $this->evento = $id;
        
    } */

    public function motrarSubirFoto(Evento $id) 
    {
        
        $this->evento = $id;
        $this->open = !$this->open;
        //dd($this->evento);
        
    }

    public function save()
    {
        //dd($this->evento);
        $nombre = $this->foto->getClientOriginalName();
        
        $ruta = $this->foto->storeAs('public/imagenes' , $nombre);
        
        $url = Storage::url($ruta);
       

        Fotografia::create([
            'image_url' => $url,
            'nombre' => $nombre,
            'eventos_id' => $this->evento->id,
            'fotografos_id' => Auth::user()->fotografo->id,
        ]);

        $usuarios = [];

        $directorios = Storage::Directories('public/usuarios');
        foreach ($directorios as $dir) {
            //dd($dir);
            $carpeta = str_replace('public/usuarios/', '', $dir);
            //dd($carpeta);
            array_push( $usuarios, $carpeta);
        }

        $this->emit('face-api', $usuarios);
    }

    public function notiAparecesFoto($idusuarios){
        //dd($idusuarios);
        $contieneIds = false;
        foreach ($idusuarios as $idusuario) {
            if ($idusuario != 'unknown') {
                ClienteFotografia::create([
                    'cliente_id' => User::find($idusuario)->cliente->id,
                    'fotografias_id' => Fotografia::latest('id')->first()->id,
                ]);
                $contieneIds = true;
            }
        }

        if ($contieneIds) {
            $this->emit('alert',['titulo' => 'Buen Trabajo','mensaje' => 'Foto Subida con exito','icono'=>'success']);
        } else {
            $this->emit('alert',['titulo' => 'Ocurrio un Error','mensaje' => 'No se reconocio a ningun usuario','icono'=>'error']);
        }
        $this->reset(['open', 'foto']);

        event(new FotoGuardada($this->evento,Fotografia::latest('id')->first()));
    }

}
