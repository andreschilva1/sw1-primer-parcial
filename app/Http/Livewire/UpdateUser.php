<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UpdateUser extends Component
{
    use WithFileUploads;

    public $open = false;
    public $usuario, $foto, $rol, $pass;
    
    

    protected $rules = [
        'usuario.name' => 'required|max:25',
        'usuario.email' => 'required|max:25',
        'rol' => 'required',
        
        
    ];

    public function mount(User $usuario)
    {

        $this->usuario = $usuario;
        $this->rol = $usuario->getRoleNames()->first();
    }

    public function save() {
        $this->validate();

        if ($this->foto) {
            Storage::delete(asset('storage/' . $this->usuario->profile_photo_path));

            $this->usuario->profile_photo_path  = $this->foto->store('perfil');
        }

        if ($this->pass != "") {
            $this->usuario->password =  Hash::make($this->pass);
        }

        $this->usuario->save();

        $rolId = Role::findByName($this->rol)->id;
        $this->usuario->roles()->sync($rolId);

        $this->reset(['foto','pass','rol']);
        $this->emitTo('show-user','render');
        $this->emit('alert',['mensaje' => 'El usuario se actualizo satisfactoriamente','icono'=>'success']);
        $this->open();
    }

    public function open()
    {
        //dd($this->rol); 
        $this->open = !$this->open;
    }

    public function render()
    {
         
        $roles = Role::all(); 
        return view('livewire.update-user',compact('roles'));
    }
}
