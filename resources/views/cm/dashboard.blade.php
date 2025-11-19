<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard CM') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Bienvenido, Community Manager</h3>
                    <p class="mb-4">Tienes acceso a las siguientes funciones:</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-blue-800">Calendarios</h4>
                            <p class="text-sm text-blue-600 mt-2">Gestionar calendarios de publicaciones</p>
                            <a href="{{ route('cm.calendarios') }}" class="text-blue-600 hover:text-blue-800 text-sm mt-2 inline-block">Ver calendarios →</a>
                        </div>

                        <div class="bg-green-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-green-800">Tareas</h4>
                            <p class="text-sm text-green-600 mt-2">Gestionar tareas de marketing</p>
                            <a href="{{ route('cm.tareas') }}" class="text-green-600 hover:text-green-800 text-sm mt-2 inline-block">Ver tareas →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
