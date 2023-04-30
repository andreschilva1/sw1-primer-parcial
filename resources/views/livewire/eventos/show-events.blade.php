<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

    {{-- Page header --}}
    <div class="sm:flex sm:justify-between sm:items-center mb-8">

        <!-- Left: Actions -->
        <div class="mb-4 sm:mb-0">

            <!-- Title -->
            <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Encuentre el evento adecuado para usted ✨</h1>


        </div>

        <!-- Right: Actions -->
        <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">

            <!-- Search form -->
            <div class="relative">
                <x-input wire:model='search' type="search" placeholder="Search…"
                    class="form-input pl-9  focus:ring-blue-500 focus:border-blue-500" />
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

            <!-- Filter button -->
            {{-- <x-dropdown-filter align="right" /> --}}

            <!-- Create events modal -->
            @livewire('eventos.create-event')

        </div>

    </div>

    <!-- Filters -->
    <div class="mb-4 border-b border-slate-200">

        <ul class="text-sm font-medium flex flex-nowrap -mx-4 sm:-mx-6 lg:-mx-8 overflow-x-scroll no-scrollbar">
            <li class="pb-3 mr-6 last:mr-0 first:pl-4 sm:first:pl-6 lg:first:pl-8 last:pr-4 sm:last:pr-6 lg:last:pr-8">
                <a class="text-indigo-500 whitespace-nowrap" href="#0">View All</a>
            </li>
            <li class="pb-3 mr-6 last:mr-0 first:pl-4 sm:first:pl-6 lg:first:pl-8 last:pr-4 sm:last:pr-6 lg:last:pr-8">
                <a class="text-slate-500 hover:text-slate-600 whitespace-nowrap" href="#0">Courses</a>
            </li>
            <li class="pb-3 mr-6 last:mr-0 first:pl-4 sm:first:pl-6 lg:first:pl-8 last:pr-4 sm:last:pr-6 lg:last:pr-8">
                <a class="text-slate-500 hover:text-slate-600 whitespace-nowrap" href="#0">Digital Goods</a>
            </li>
            <li class="pb-3 mr-6 last:mr-0 first:pl-4 sm:first:pl-6 lg:first:pl-8 last:pr-4 sm:last:pr-6 lg:last:pr-8">
                <a class="text-slate-500 hover:text-slate-600 whitespace-nowrap" href="#0">Online Events</a>
            </li>
            <li class="pb-3 mr-6 last:mr-0 first:pl-4 sm:first:pl-6 lg:first:pl-8 last:pr-4 sm:last:pr-6 lg:last:pr-8">
                <a class="text-slate-500 hover:text-slate-600 whitespace-nowrap" href="#0">Crowdfunding</a>
            </li>
        </ul>

        <div class="m-4 sm:mb-0">
            <label class="mr4" for="">
                Mostrar
            </label>
            <select class="form-select" wire:model="count">

                <option value="4">4</option>
                <option value="8">8</option>
                <option value="16">16</option>
                <option value="32">32</option>
                <option value="64">64</option>

            </select>
            <label class="ml4" for="">
                Items
            </label>

        </div>
    </div>

    <!-- Page content -->
    <div>


        <div class="mt-8">
            @if ($eventos->isEmpty())
                <h2 class="text-xl leading-snug text-slate-800 font-bold mb-5">No existe ningun registro coincidente
                </h2>
            @else
                <h2 class="text-xl leading-snug text-slate-800 font-bold mb-5">Eventos disponibles</h2>
            @endif

            <div class="grid grid-cols-12 gap-6">
                @foreach ($eventos as $evento)
                    <x-events.shop-cards-03 titulo="{{ $evento->nombre }}" direccion="{{ $evento->direccion }}"
                        fecha="{{ $evento->fecha }}" hora="{{ $evento->hora }}" foto="{{$evento->photo_path}}" />
                @endforeach
            </div>
        </div>

        <div class="px-6 py-3">

            {{ $eventos->links() }}

        </div>
    </div>

</div>
