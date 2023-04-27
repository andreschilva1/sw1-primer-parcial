<div class="flex">
    {{-- <x-button class="ml-auto" wire:click=openCLose()>
        Crear nuevo usuario
    </x-button> --}}
    <button class=" btn bg-indigo-500 hover:bg-indigo-600 text-white" wire:click=$set('open',true)>
        <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
            <path
                d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
        </svg>
        <span class="hidden xs:block ml-2">Add Usuario</span>
    </button>
    {{--  <button class="bg-blue-500 text-white font-bold py-2 px-4  ml-auto">
        Botón a la derecha
      </button> --}}

    <x-dialog-modal wire:model="open">

        <x-slot name="title">
            Crear Nuevo Usuario
        </x-slot>

        <x-slot name="content">
            <div class="px-4 ">

                <label for="">
                    Foto de Perfil<span class="text-rose-500">*</span>
                </label>

                <div class="flex items-center">
                    <div class="m-3">

                        @if ($foto)
                            <img class="h-24 w-24 rounded-full" src="{{ $foto->temporaryUrl() }}" alt="">
                        @else
                            <img class="h-24 w-24 rounded-full" src="{{ asset('images/avatar-01.jpg') }}"
                                alt="">
                        @endif

                    </div>

                    <x-input type="file" class="w-full" id="{{$identificador}}" wire:model="foto" />

                </div>
                <div class="mb-3">
                    <x-input-error for="foto" />
                </div>



                <div class="mb-4">
                    <label class="" for="">
                        Nombre <span class="text-rose-500">*</span>
                    </label>

                    <x-input type="text" class=" w-full " wire:model="name" />
                    <x-input-error for="name" />

                </div>


                <div class="mb-4">
                    <label for="">
                        email <span class="text-rose-500">*</span>
                    </label>
                    <x-input type="email" class="w-full" wire:model="email" />
                    <x-input-error for="email" />

                </div>

                <div class="mb-4">
                    <label for="">
                        password<span class="text-rose-500">*</span>
                    </label>
                    <x-input type="password" class="w-full" wire:model="password" />
                    <x-input-error for="password" />

                </div>

                <div class="mb-4">
                    <label class="mr4" for="">
                        Tipo de Usuario<span class="text-rose-500">*</span>
                    </label>
                    
                    <select class="form-select w-full" wire:model="rol">
                        <option value=""></option>
                        @foreach ($roles as $rol)
                       <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                       @endforeach
                    </select>
                    <x-input-error for="rol" />

                </div>


            </div>

        </x-slot>

        <x-slot name="footer">
            <div class="mr-4">

                <button class="btn-sm border-slate-200 hover:border-slate-300 text-slate-600"
                    wire:click=$set('open',false)>Cancelar</button>

                <button
                    class="btn-sm bg-indigo-500 hover:bg-indigo-600 text-white disabled:border-slate-200 disabled:bg-slate-100 disabled:text-slate-400 disabled:cursor-not-allowed shadow-none"
                    wire:loading.attr="disabled" wire:target="save,foto" wire:click=save()>
                    <svg wire:loading wire:target="save,foto" class="animate-spin w-4 h-4 fill-current shrink-0"
                        viewBox="0 0 16 16">
                        <path
                            d="M8 16a7.928 7.928 0 01-3.428-.77l.857-1.807A6.006 6.006 0 0014 8c0-3.309-2.691-6-6-6a6.006 6.006 0 00-5.422 8.572l-1.806.859A7.929 7.929 0 010 8c0-4.411 3.589-8 8-8s8 3.589 8 8-3.589 8-8 8z">
                        </path>
                    </svg>
                    <span class="ml-2" wire:loading.remove wire:target="save,foto">Guardar</span>
                    <span wire:loading wire:target="save,foto"> cargando </span>

                </button>

            </div>

        </x-slot>
    </x-dialog-modal>


</div>
