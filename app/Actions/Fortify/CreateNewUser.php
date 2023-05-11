<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Spatie\Permission\Models\Role as Roles;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use App\Models\Cliente;
use App\Models\Fotografo;
use App\Models\Organizador;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;
    use WithFileUploads;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {   
        //dd($input);

        if ($input['rol'] == '3') {
            Validator::make($input, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => $this->passwordRules(),
                'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
                'rol' => ['required'],
                'foto1' => ['required','image','max:2048'],
                'foto2' => ['required','image','max:2048'],
                'foto3' => ['required','image','max:2048'],
            ])->validate();

            $user = User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'tipo' => "Cliente",
            ]);
    
            $user->assignRole($input['rol']);
           
            $urls = [];
            $i = 1;
            foreach ($input as $key => $value) {
                if ($key == 'foto1' || $key == 'foto2' || $key == 'foto3') {
                    $ruta =  $input[$key]->storeAs('public/usuarios/'. $user->id , $i.'.jpg');
                    $url = Storage::url($ruta);
                    $urls['ruta'.$i] = $url;
                    $i++;
                }
            }
           
            Cliente::create([
                'foto1' => $urls['ruta1'],
                'foto2' => $urls['ruta2'],
                'foto3' => $urls['ruta3'],
                'user_id' => $user->id
            ]);
            

            $user->save();

            return $user;
            
        }else {
           
            Validator::make($input, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => $this->passwordRules(),
                'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
                'rol' => ['required'],
            ])->validate();
            
        }

        

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        $user->assignRole($input['rol']);

        if ($input['rol'] == '2') {
            $user->tipo = 'Organizador';
            Organizador::create([
                'user_id' => $user->id
            ]);
        }else {
            $user->tipo = 'Fotografo';
            Fotografo::create([
                'user_id' => $user->id
            ]);
        }
            return $user;
    }

}
