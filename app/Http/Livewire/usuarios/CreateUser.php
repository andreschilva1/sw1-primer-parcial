<?php

namespace App\Http\Livewire\usuarios;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CreateUser extends Component
{
    use WithFileUploads;

    public $open= false;
    public $name, $email, $password,$rol, $foto, $identificador;
    public $path;


    protected $rules = [
        'name' => 'required|max:25',
        'email' => 'required|unique:users|max:25',
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

        $foto = $this->foto->store('perfil');

        $usuario->name = $this->name;
        $usuario->email = $this->email;
        $usuario->password =  Hash::make($this->password);
        $usuario->profile_photo_path = $foto;
        
        
        if ($usuario->save()) {
            $usuario->roles()->sync($this->rol);
            $alerta = ['mensaje' => 'El usuario se creo satisfactoriamente','icono'=>'success'];
            
        } else {
            $alerta = ['mensaje' => 'Error no se pudo crear el usuario','icono'=>'error'];
            
        }
        
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
