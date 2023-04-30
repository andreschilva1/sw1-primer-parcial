<?php

namespace App\Http\Livewire\usuarios;

use App\Models\User;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class ShowUser extends Component
{
    
    use WithFileUploads;
    use WithPagination;

    public $search;
    
    public $usuario, $foto, $rol, $pass, $identificador; 
    public $count = 5;
    public $openEdit = false;
    
    protected $listeners = ['render' => 'render', 'delete' => 'delete']; 
    
    protected $rules = [
        'usuario.name' => 'required|max:25',
        'usuario.email' => 'required|email|max:25',
        'rol' => 'required', 
    ];

    public function render()
    {       
            
            $roles = Role::all(); 
            $usuarios = User::join('model_has_roles','model_has_roles.model_id', 'users.id')
            ->join('roles', 'roles.id', 'model_has_roles.role_id')->select('users.*','roles.name as rol')
            ->where('users.name','like','%'. $this->search .'%')
            ->orWhere('users.email','like','%'. $this->search .'%')
            ->orwhere('roles.name','like','%'. $this->search .'%')->orderBy('users.id','desc')->paginate($this->count);

            /* $usuarios = User::join($this->rol, $this->rol.'.user_id', 'users.id')->where('name','like','%'. $this->search .'%')
            ->orWhere('email','like','%'. $this->search .'%')->get(); */

            /* $usuarios = User::where('name','like','%'. $this->search .'%')
            ->orWhere('email','like','%'. $this->search .'%')->paginate(5); */
        
        return view('livewire.usuarios.show-user',compact('usuarios','roles'));
    }

    

    public function mount()
    {

        $this->usuario = new User();
        $this->identificador = rand();
        
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function updatingCount(){
        $this->resetPage();
    }


    public function updatedOpenEdit()
    {
        if ($this->openEdit == false) {
            $this->reset(['foto','pass','rol']);
            $this->identificador = rand();
        }
    }
    

    public function edit(User $user) {
        $this->usuario = $user;
       // dd($this->usuario->model_has_role->role->name);
        $this->rol = $this->usuario->model_has_role->role_id;
        $this->openEdit = true; 
       
    }

    public function update() {
        $this->validate();

        
        if ($this->foto) {
            //dump(asset('storage/' . $this->usuario->profile_photo_path));
            if ($this->usuario->profile_photo_path) {
                
                Storage::delete($this->usuario->profile_photo_path);
            }

            $this->usuario->profile_photo_path  = $this->foto->store('perfil');
        }

        if ($this->pass != "") {
            $this->usuario->password =  Hash::make($this->pass);
        }

        $this->usuario->save();

        $this->usuario->roles()->sync($this->rol);

        $this->reset(['foto','pass','rol']);

        $this->emit('alert',['mensaje' => 'El usuario se actualizo satisfactoriamente','icono'=>'success']);
        $this->openEdit = !$this->openEdit;
    }

    public function delete(User $user) {

        if ($user->profile_photo_path) {
            Storage::delete($user->profile_photo_path);
        }

        $user->delete();
    }
}
