{{-- <div>
    <!-- component -->

    <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">

        <div class="px-6 py-4">

             @livewire('create-user')
            
            <div class="relative mt-1">
                <div class="absolute   pl-3  pointer-events-none py-3">
                   
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                    
                    
                </div>
                
                
                <x-input wire:model="search"
                class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
               
            </div>
            
          
        </div>
        

        <table class="w-full border-collapse bg-white text-left text-sm text-gray-500" >
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Id</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Nombre</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Correo</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Accion</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                @foreach ($usuarios as $usuario)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $usuario->id }}</td>
                        <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                            <div class="relative h-10 w-10">
                                <img class="h-full w-full rounded-full object-cover object-center"
                                    src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                    alt="" />
                                <span
                                    class="absolute right-0 bottom-0 h-2 w-2 rounded-full bg-green-400 ring ring-white"></span>
                            </div>
                            <div class="text-sm">
                                <div class="font-medium text-gray-700">{{ $usuario->name }}</div>
                            </div>
                        </th>

                        <td class="px-6 py-4">{{ $usuario->email }}</td>

                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-4">
                                <a x-data="{ tooltip: 'Delete' }" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="h-6 w-6" x-tooltip="tooltip">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </a>
                                @livewire('update-user', ['usuario' => $usuario], key($usuario->id))
                            </div>
                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>
</div> --}}
<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

    <!-- Page header -->
    <div class="sm:flex sm:justify-between sm:items-center mb-5">

        <!-- Left: Title -->
        <div class="mb-4 sm:mb-0">
            <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Usuarios ✨</h1>
        </div>

        <!-- Right: Actions -->
        <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">

            <!-- Search form -->
            <div class="relative mt-1">
                <div class="absolute   pl-3  pointer-events-none py-2">

                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>


                </div>

                <x-input wire:model="search" class="form-input pl-9 focus:ring-blue-500 focus:border-blue-500" />
                {{-- <x-input wire:model="search"
                    class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" /> --}}

            </div>
            {{-- <x-search-form placeholder="Search by invoice ID…" /> --}}

            <!-- Create invoice button -->
            @livewire('usuarios.create-user')

        </div>

    </div>

    <!-- More actions -->
    <div class="sm:flex sm:justify-between sm:items-center mb-5">

        
        <div class="mb-4 sm:mb-0">
            <label class="mr4" for="">
                Mostrar
            </label>
            <select class="form-select" wire:model="count">

                <option value="5">5</option>
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>

            </select>
            <label class="ml4" for="">
                Filas
            </label>

        </div>

        <!-- Right side -->
        <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">

            {{--  <!-- Delete button -->
            <x-actions.delete-button />

            <!-- Dropdown -->
            <x-date-select />

            <!-- Filter button -->
            <x-dropdown-filter align="right" /> --}}

        </div>

    </div>


    <!-- Table -->

    @if (!$usuarios->isEmpty())
        <table class="min-w-full  border-collapse block md:table">
            <thead class="bg-gray-50 block md:table-header-group">
                <tr
                    class=" border border-gray-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
                    <th
                        class=" p-2 text-gray-900 font-bold  md:border-2 md:border-grey-500 text-left block md:table-cell">
                        Id</th>
                    <th
                        class=" p-2 text-gray-900 font-bold md:border-2 md:border-grey-500 text-left block md:table-cell">
                        Foto</th>
                    <th
                        class="p-2 text-gray-900 font-bold md:border-2 md:border-grey-500 text-left block md:table-cell">
                        Nombre</th>
                    <th
                        class=" p-2 text-gray-900 font-bold md:border-2 md:border-grey-500 text-left block md:table-cell">
                        Email Address</th>

                    <th
                        class=" p-2 text-gray-900 font-bold md:border-2 md:border-grey-500 text-left block md:table-cell">
                        Rol</th>

                    <th
                        class=" p-2 text-gray-900 font-bold md:border-2 md:border-grey-500 text-left block md:table-cell">
                        Actions</th>
                </tr>
            </thead>
            <tbody class="block md:table-row-group">
                @foreach ($usuarios as $user)
                    <tr
                        class="bg-gray-100 border-2 hover:bg-gray-300 border-gray-500 rounded-lg m-2 md:border-none block md:table-row">


                        <td class="  p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                class="inline-block w-1/3 md:hidden font-bold">Id:</span>

                            <div class="flex justify-center">
                                {{ $user->id }}

                            </div>


                        </td>
                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                class="inline-block w-1/3 md:hidden font-bold">Foto:</span>

                            <div class=" flex justify-center">

                                @if ($user->profile_photo_path)
                                    <a href="#" wire:click="edit({{ $user->id }})">
                                        <img class=" h-14 w-14 m-1 rounded-full object-cover object-center  relative "
                                            src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="" />
                                    </a>
                                @else
                                    <a class=" h-14 w-14 bg-indigo-400 rounded-full border-black border-2 text-slate-700 hover:bg-indigo-500 hover:text-black"
                                        href="#" wire:click="edit({{ $user->id }})">
                                        <img class="mt-3 ml-2 h-9 w-9 m-1  object-cover object-center  relative "
                                            src="{{ asset('images/imagen.png') }}" alt="" />
                                    </a>
                                @endif

                            </div>

                        </td>
                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                class="inline-block w-1/3 md:hidden font-bold">Nombre:</span>{{ $user->name }}</td>
                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                class="inline-block w-1/3 md:hidden font-bold">Email:</span>{{ $user->email }}
                        </td>

                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                            <span class="inline-block w-1/3 md:hidden font-bold">Rol:</span>

                            @if ($user->getRoleNames()->first())
                                
                                {{$user->getRoleNames()->first()}}
                            @else
                                sin Rol 

                            @endif


                        </td>

                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                            <span class="inline-block w-1/3 md:hidden font-bold">Actions:</span>
                            <div class="flex justify-center gap-4">

                                {{--  @livewire('update-user', ['usuario' => $usuario, 'rol'], key($usuario->id)) --}}

                                <a class="btn-sm border-2 border-black bg-indigo-400 rounded-lg text-slate-700 hover:bg-indigo-500 hover:text-black"
                                    href="#" wire:click="edit({{ $user->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="h-6 w-6" x-tooltip="tooltip">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                    </svg>
                                </a>


                                <a class="btn-sm border-2 border-black bg-indigo-400 rounded-lg text-slate-700 hover:bg-indigo-500 hover:text-black"
                                    href="#" wire:click="$emit('deleteUser',{{ $user->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="h-6 w-6"
                                        x-tooltip="tooltip">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </a>

                            </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        <div class="px-6 py-3">

            {{ $usuarios->links() }}
    
        </div>

    @else
        <span>No existe ningun registro coincidente </span>

    @endif

    <!-- Pagination -->
    

    <x-dialog-modal wire:model="openEdit">

        <x-slot name="title">
            Actualizar Usuario
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
                        @elseif($usuario->profile_photo_path)
                            <img class="h-24 w-24 rounded-full"
                                src="{{ asset('storage/' . $usuario->profile_photo_path) }}" alt="">
                        @else
                            <span class="btn-sm bg-indigo-500 rounded-lg text-slate-700">
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0"
                                    y="0" width="40" height="40" viewBox="0 0 134 134"
                                    xml:space="preserve">
                                    <circle cx="67" cy="67" r="65" fill="#d2d2d2">
                                    </circle>
                                    <path
                                        d="M67 2c35.841 0 65 29.159 65 65s-29.159 65-65 65S2 102.841 2 67 31.159 2 67 2m0-1C30.55 1 1 30.55 1 67s29.55 66 66 66 66-29.55 66-66S103.45 1 67 1z"
                                        fill="#0c0d0d" opacity=".2"></path>
                                    <path class="st3"
                                        d="M65.92 66.34h2.16c14.802.421 30.928 6.062 29.283 20.349l-1.618 13.322c-.844 6.814-5.208 7.827-13.972 7.865H52.23c-8.765-.038-13.13-1.05-13.974-7.865l-1.62-13.322C34.994 72.402 51.12 66.761 65.92 66.341zM49.432 43.934c0-9.819 7.989-17.81 17.807-17.81 9.822 0 17.81 7.991 17.81 17.81 0 9.819-7.988 17.807-17.81 17.807-9.818 0-17.807-7.988-17.807-17.807z">
                                    </path>
                                </svg>
                            </span>
                        @endif



                    </div>

                    <x-input type="file" class="w-full" id="{{ $identificador }}" wire:model="foto" />

                </div>
                <div class="mb-3">
                    <x-input-error for="foto" />
                </div>



                <div class="mb-4">
                    <label class="" for="">
                        Nombre <span class="text-rose-500">*</span>
                    </label>

                    <x-input type="text" class=" w-full " wire:model="usuario.name" />
                    <x-input-error for="usuario.name" />

                </div>


                <div class="mb-4">
                    <label for="">
                        email <span class="text-rose-500">*</span>
                    </label>
                    <x-input type="email" class="w-full" wire:model="usuario.email" />
                    <x-input-error for="usuario.email" />

                </div>

                <div class="mb-4">
                    <label for="">
                        password<span class="text-rose-500">*</span>
                    </label>
                    <x-input type="password" class="w-full" wire:model="pass" />
                    <x-input-error for="pass" />


                    <div class="mb-4">
                        <label class="mr4" for="">
                            Tipo de Usuario<span class="text-rose-500">*</span>
                        </label>

                        <select class="form-select w-full" wire:model="rol">
                            <option value="{{ $rol }}"></option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="rol" />

                    </div>


                </div>

        </x-slot>

        <x-slot name="footer">
            <div class="mr-4">

                <button class="btn-sm border-slate-200 hover:border-slate-300 text-slate-600"
                    wire:click="$set('openEdit',false)">Cancelar</button>

                <button
                    class="btn-sm bg-indigo-500 hover:bg-indigo-600 text-white disabled:border-slate-200 disabled:bg-slate-100 disabled:text-slate-400 disabled:cursor-not-allowed shadow-none"
                    wire:loading.attr="disabled" wire:target="update,foto" wire:click=update()>
                    <svg wire:loading wire:target="update,foto" class="animate-spin w-4 h-4 fill-current shrink-0"
                        viewBox="0 0 16 16">
                        <path
                            d="M8 16a7.928 7.928 0 01-3.428-.77l.857-1.807A6.006 6.006 0 0014 8c0-3.309-2.691-6-6-6a6.006 6.006 0 00-5.422 8.572l-1.806.859A7.929 7.929 0 010 8c0-4.411 3.589-8 8-8s8 3.589 8 8-3.589 8-8 8z">
                        </path>
                    </svg>
                    <span class="ml-2" wire:loading.remove wire:target="update,foto">Actualizar</span>
                    <span wire:loading wire:target="update,foto"> cargando </span>

                </button>

            </div>

        </x-slot>
    </x-dialog-modal>


    @push('js')
        <script>
            Livewire.on('deleteUser', userId => {
                Swal.fire({
                    title: 'Estas seguro?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#7066e0',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Eliminiar!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emitTo('usuarios.show-user', 'delete', userId);
                        Swal.fire(
                            'Eliminado!',
                            'El usuario ha sido eliminado.',
                            'success'
                        )
                    }
                })
            })
        </script>
    
    
    @endpush

</div>
