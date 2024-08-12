<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="flex max-w-7xl mx-auto sm:px-6 lg:px-8 gap-4">


            @role('admin|seller|buyer')
            <div class="bg-red-300 overflow-hidden shadow-sm sm:rounded-lg w-full ">
                <div class="p-6 text-gray-900">
                    {{ __("Admin | Seller | Buyer") }}
                </div>
            </div>


            @role('admin|seller')
            <div class="bg-green-300 overflow-hidden shadow-sm sm:rounded-lg w-full">
                <div class="p-6 text-gray-900">
                    {{ __("Admin|Seller") }}
                </div>
            </div>
            @endrole

            @role('admin')
            <div class="bg-yellow-300 overflow-hidden shadow-sm sm:rounded-lg w-full">
                <div class="p-6 text-gray-900">
                    {{ __("Admin") }}
                </div>
            </div>
            @endrole
            @endrole

        </div>

        {{-- <div class="flex max-w-7xl mx-auto sm:px-6 lg:px-8 gap-4 p-5">


            @if(Auth::user()->hasRole(['admin|seller|buyer']))
            <div class="bg-red-900 overflow-hidden shadow-sm sm:rounded-lg w-full ">
                <div class="p-6 text-gray-900">
                    {{ __("Admin | Seller | Buyer") }}
                </div>
            </div>
            @endif

            @if(Auth::user()->hasRole(['admin|seller']))
            <div class="bg-green-900 overflow-hidden shadow-sm sm:rounded-lg w-full">
                <div class="p-6 text-gray-900">
                    {{ __("Admin|Seller") }}
                </div>
            </div>
            @endif

            @if(Auth::user()->hasRole('admin'))
            <div class="bg-yellow-900 overflow-hidden shadow-sm sm:rounded-lg w-full">
                <div class="p-6 text-gray-900">
                    {{ __("Admin") }}
                </div>
            </div>
            @endif

        </div>
    </div> --}}
</x-app-layout>
