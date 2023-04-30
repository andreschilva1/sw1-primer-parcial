<div>

    <button class="btn bg-indigo-500 hover:bg-indigo-600 text-white" wire:click=$set('open',true)>
        <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
            <path
                d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
        </svg>
        <span class=" hidden xs:block ml-2">Add Evento</span>
    </button>

    <x-dialog-modal wire:model="open">

        <x-slot name="title">
            Crear Nuevo Evento
        </x-slot>


        <x-slot name="content">
            <div class=" overflow-auto max-h-[600px]">

                @if ($foto)
                    <img class="w-full h-96" src="{{ $foto->temporaryUrl() }}" alt="">
                @endif

                <!-- Input Types -->
                <div class="px-4 py-4">


                    <div class="grid gap-5 md:grid-cols-2 mb-3">

                        <div>
                            <!-- Start -->
                            <div>
                                <label class="block text-sm font-medium mb-1">Titulo<span
                                        class="text-rose-500">*</span></label>
                                <input class="form-input w-full" type="text" wire:model="titulo" />
                            </div>

                            <div class="mb-3">
                                <x-input-error for="titulo" />
                            </div>
                            <!-- End -->
                        </div>


                        <div>
                            <!-- Start -->
                            <div>
                                <label class="block text-sm font-medium mb-1" for="mandatory">Direccion <span
                                        class="text-rose-500">*</span></label>
                                <input class="form-input w-full" type="text" wire:model="direccion" />
                            </div>
                            <div class="mb-3">
                                <x-input-error for="direccion" />
                            </div>
                            <!-- End -->
                        </div>

                        <div class="col-span-2">
                            <!-- Start -->
                            <div>
                                <label class="block text-sm font-medium mb-1" for="mandatory">Descripcion</label>
                                <textarea wire:model="descripcion" rows="4"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-indigo-400 focus:border-indigo-400 "
                                    placeholder="..."></textarea>
                            </div>
                            <div class="mb-3">
                                <x-input-error for="descripcion" />
                            </div>
                            <!-- End -->
                        </div>

                        <div>
                            <!-- Start -->
                            <div>
                                <label class="block text-sm font-medium mb-1">fecha<span
                                    class="text-rose-500">*</span></label>
                                <div class="relative">
                                    <input class="form-input w-full" type="date" wire:model="fecha" />
                                    {{-- <div class="absolute inset-0 right-auto flex items-center pointer-events-none">
                                                <span class="text-sm text-slate-400 font-medium px-3">USD</span>
                                            </div> --}}
                                </div>

                            </div>
                            <div class="mb-3">
                                <x-input-error for="fecha" />
                            </div>
                            <!-- End -->
                        </div>

                        <div>
                            <!-- Start -->
                            <div>
                                <label class="block text-sm font-medium mb-1" for="mandatory">hora <span
                                        class="text-rose-500">*</span></label>
                                <input class="form-input w-full" type="time" wire:model="hora" />
                            </div>
                            <!-- End -->
                            <div class="mb-3">
                                <x-input-error for="hora" />
                            </div>
                        </div>



                    </div>

                    <label class="">
                        Agregar Foto
                    </label>
                    <div class="mt-1">
                        <x-input type="file" class="mb-3" id="{{ $identificador }}" wire:model="foto" />

                    </div>

                    <div class=" mb-2">
                        <label>
                            Agregar Fotografos
                        </label>
                        <div class="mt-1 relative">
                            <x-input wire:model='searchFotografo' type="search" placeholder="buscar fotografos"
                                class="form-input pl-9 w-full  focus:ring-blue-500 focus:border-blue-500" />
                            <span class="absolute pr-3 pt-2.5 inset-0 right-auto  ">
                                <svg class=" w-4 h-4 shrink-0 fill-current text-slate-400 group-hover:text-slate-500 ml-3 mr-2"
                                    viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7 14c-3.86 0-7-3.14-7-7s3.14-7 7-7 7 3.14 7 7-3.14 7-7 7zM7 2C4.243 2 2 4.243 2 7s2.243 5 5 5 5-2.243 5-5-2.243-5-5-5z" />
                                    <path
                                        d="M15.707 14.293L13.314 11.9a8.019 8.019 0 01-1.414 1.414l2.393 2.393a.997.997 0 001.414 0 .999.999 0 000-1.414z" />
                                </svg>
                            </span>
                        </div>

                    </div>

                    @if (!$fotografos->isEmpty())
                        <div class="overflow-auto h-48 mb-2">
                            <table class="min-w-full  border-collapse block md:table">
                                <thead class="bg-gray-50 block md:table-header-group">
                                    <tr
                                        class=" border border-gray-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">

                                        <th
                                            class=" p-2 text-gray-900 font-bold md:border-2 md:border-grey-500 text-left block md:table-cell">
                                            Foto</th>
                                        <th
                                            class="p-2 text-gray-900 font-bold md:border-2 md:border-grey-500 text-left block md:table-cell">
                                            Nombre</th>

                                        <th
                                            class="p-2 text-gray-900 font-bold md:border-2 md:border-grey-500 text-left block md:table-cell">
                                            Action</th>

                                    </tr>
                                </thead>
                                <tbody class="block md:table-row-group">
                                    @foreach ($fotografos as $fotografo)
                                        <tr
                                            class="bg-gray-100 border-2 hover:bg-gray-300 border-gray-500 rounded-lg m-2 md:border-none block md:table-row">

                                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                                <span class="inline-block w-1/3 md:hidden font-bold">Foto:</span>

                                                <div class=" flex justify-center">

                                                    @if ($fotografo->user->profile_photo_path)
                                                        <a href="#" wire:click="edit({{ $fotografo->user->id }})">
                                                            <img class=" h-14 w-14 m-1 rounded-full object-cover object-center  relative "
                                                                src="{{ asset('storage/' . $fotografo->user->profile_photo_path) }}"
                                                                alt="" />
                                                        </a>
                                                    @else
                                                        <a class=" h-14 w-14 bg-indigo-400 rounded-full border-black border-2 text-slate-700 hover:bg-indigo-500 hover:text-black"
                                                            href="#"
                                                            wire:click="edit({{ $fotografo->user->id }})">
                                                            <img class="mt-3 ml-2 h-9 w-9 m-1  object-cover object-center  relative "
                                                                src="{{ asset('images/imagen.png') }}" alt="" />
                                                        </a>
                                                    @endif

                                                </div>

                                            </td>
                                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                                <span
                                                    class="inline-block w-1/3 md:hidden font-bold">Nombre:</span>{{ $fotografo->user->name }}
                                            </td>

                                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                                <span class="inline-block w-1/3 md:hidden font-bold">Nombre:</span>

                                                <button class="btn bg-indigo-500 hover:bg-indigo-600 text-white"
                                                    wire:click=$set('open',true)>
                                                    <svg class="w-4 h-4 fill-current opacity-50 shrink-0"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                                                    </svg>
                                                    <span class="hidden xs:block ml-2">Add Solicitud</span>
                                                </button>

                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                    @else
                        <span class="text-rose-500 mb-4">No existe ningun registro coincidente</span>

                    @endif


                    <div class="mb-2">
                        <label for="">
                            Agregar Invitados
                        </label>
                        <div class="mt-1 relative">
                            <x-input wire:model='searchCliente' type="search" placeholder="Buscar invitados…"
                                class="form-input pl-9 w-full  focus:ring-blue-500 focus:border-blue-500" />
                            <span class="absolute pr-3 pt-2.5 inset-0 right-auto  ">
                                <svg class=" w-4 h-4 shrink-0 fill-current text-slate-400 group-hover:text-slate-500 ml-3 mr-2"
                                    viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7 14c-3.86 0-7-3.14-7-7s3.14-7 7-7 7 3.14 7 7-3.14 7-7 7zM7 2C4.243 2 2 4.243 2 7s2.243 5 5 5 5-2.243 5-5-2.243-5-5-5z" />
                                    <path
                                        d="M15.707 14.293L13.314 11.9a8.019 8.019 0 01-1.414 1.414l2.393 2.393a.997.997 0 001.414 0 .999.999 0 000-1.414z" />
                                </svg>
                            </span>
                        </div>

                    </div>

                    @if (!$clientes->isEmpty())
                        <div class="overflow-auto h-48 mb-2">
                            <table class="min-w-full  border-collapse block md:table">
                                <thead class="bg-gray-50 block md:table-header-group">
                                    <tr
                                        class=" border border-gray-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">

                                        <th
                                            class=" p-2 text-gray-900 font-bold md:border-2 md:border-grey-500 text-left block md:table-cell">
                                            Foto</th>
                                        <th
                                            class="p-2 text-gray-900 font-bold md:border-2 md:border-grey-500 text-left block md:table-cell">
                                            Nombre</th>

                                        <th
                                            class="p-2 text-gray-900 font-bold md:border-2 md:border-grey-500 text-left block md:table-cell">
                                            Action</th>

                                    </tr>
                                </thead>
                                <tbody class="block md:table-row-group">
                                    @foreach ($clientes as $invitado)
                                        <tr
                                            class="bg-gray-100 border-2 hover:bg-gray-300 border-gray-500 rounded-lg m-2 md:border-none block md:table-row">

                                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                                <span class="inline-block w-1/3 md:hidden font-bold">Foto:</span>

                                                <div class=" flex justify-center">

                                                    @if ($invitado->user->profile_photo_path)
                                                        <a href="#"
                                                            wire:click="edit({{ $invitado->user->id }})">
                                                            <img class=" h-14 w-14 m-1 rounded-full object-cover object-center  relative "
                                                                src="{{ asset('storage/' . $invitado->user->profile_photo_path) }}"
                                                                alt="" />
                                                        </a>
                                                    @else
                                                        <a class=" h-14 w-14 bg-indigo-400 rounded-full border-black border-2 text-slate-700 hover:bg-indigo-500 hover:text-black"
                                                            href="#"
                                                            wire:click="edit({{ $invitado->user->id }})">
                                                            <img class="mt-3 ml-2 h-9 w-9 m-1  object-cover object-center  relative "
                                                                src="{{ asset('images/imagen.png') }}"
                                                                alt="" />
                                                        </a>
                                                    @endif

                                                </div>

                                            </td>
                                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                                <span
                                                    class="inline-block w-1/3 md:hidden font-bold">Nombre:</span>{{ $invitado->user->name }}
                                            </td>

                                            <td
                                                class=" p-2 md:align-middle md:border md:border-grey-500 text-left block md:table-cell">
                                                <span class="inline-block w-1/3 md:hidden font-bold">Nombre:</span>

                                                <button class="btn bg-indigo-500 hover:bg-indigo-600 text-white"
                                                    wire:click=$set('open',true)>
                                                    <svg class="w-4 h-4 fill-current opacity-50 shrink-0"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                                                    </svg>
                                                    <span class="hidden xs:block ml-2">Add Solicitud</span>
                                                </button>

                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                    @else
                        <span class="text-rose-500 mb-4">No existe ningun registro coincidente</span>

                    @endif

                </div>


                {{--  <div class="px-4 ">
    
                    <label for="">
                        Foto de Perfil<span class="text-rose-500">*</span>
                    </label>
    
                    <div class="flex items-center">
                        <div class="m-3">
    
                            @if ($foto)
                                <img  class="h-24 w-24 rounded-full" src="{{ $foto->temporaryUrl() }}" alt="">
                            @else
                                <span class="btn-sm bg-indigo-400 rounded-lg text-slate-700"
                                    >
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
    
    
                </div> --}}

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
