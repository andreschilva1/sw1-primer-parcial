<?php

namespace App\Http\Livewire\usuarios;

use App\Listeners\notificaciones\SendNotificacionUsuario;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Cliente;
use App\Models\Fotografo;
use App\Models\Organizador;

class CreateUser extends Component
{
    use WithFileUploads;

    public $open= false;
    public $name, $email, $password,$rol, $foto, $identificador;
    public $path;


    protected $rules = [
        'name' => 'required|max:25',
        'email' => 'required|email|unique:users|max:25',
        'password' => 'required|max:50',
        'rol' => 'required',
        'foto' => 'required|image|max:2048'
        
    ];
    
    public function mount()
    {
        $this->identificador = rand();
    }
    
    public function updatedOpen()
    {
        if ($this->open == true) {
            $this->reset(['name','email','foto','password','rol']);
            $this->identificador = rand();
        }
    }
    
       
    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    }

    
    public function save()
    {
        $this->validate();
        $alerta = [];
        $usuario = new User();
        
        //$foto = $this->foto->store('public/clientes/');
        

        $usuario->name = $this->name;
        $usuario->email = $this->email;
        $usuario->password =  Hash::make($this->password);
        $usuario->save();

        $nombre = $this->foto->getClientOriginalName();
        //dd($usuario->id);
        $ruta = $this->foto->storeAs('public/perfil/' . $usuario->id , $nombre);
        $url = Storage::url($ruta);

        $usuario->profile_photo_path = $url;
        $usuario->save();
        
        $usuario->roles()->sync($this->rol);
        if ($usuario->model_has_role->role->name == 'Cliente') {
            Cliente::create([
                'user_id' => $usuario->id,
            ]);
            $usuario->estado = 'Cliente';
            $usuario->save();
        }elseif($usuario->model_has_role->role->name == 'Fotografo'){
            Fotografo::create([
                'user_id' => $usuario->id,
            ]);
            
            $usuario->estado = 'Fotografo';
            $usuario->save();
       
        }elseif($usuario->model_has_role->role->name == 'Organizador'){
            Organizador::create([
                'user_id' => $usuario->id,
            ]);

            $usuario->estado = 'Cliente';
            $usuario->save();
       
        }
        
        
        
        $alerta = ['mensaje' => 'El usuario se creo satisfactoriamente','icono'=>'success'];
        
        $this->reset(['name', 'email','password','foto']);
        $this->emitTo('usuarios.show-user','render');
        $this->emit('alert',$alerta);
        $this->open = !$this->open;
        
    }

    public function render()
    {
        $roles = Role::all();
        return view('livewire.usuarios.create-user',compact('roles'));
    }
}
