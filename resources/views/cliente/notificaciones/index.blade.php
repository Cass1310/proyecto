<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis Notificaciones') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Estadísticas -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <p class="text-2xl font-bold text-gray-900">{{ auth()->user()->notifications()->count() }}</p>
                        <p class="text-sm text-gray-500">Total</p>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <p class="text-2xl font-bold text-yellow-600">{{ auth()->user()->notificacionesNoLeidas()->count() }}</p>
                        <p class="text-sm text-gray-500">Sin leer</p>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <p class="text-2xl font-bold text-gray-900">{{ auth()->user()->notifications()->where('is_read', true)->count() }}</p>
                        <p class="text-sm text-gray-500">Leídas</p>
                    </div>
                </div>
            </div>

            <!-- Acciones -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-4 border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-900">Todas las notificaciones</h3>
                        <div class="flex space-x-2">
                            @if(auth()->user()->notificacionesNoLeidas()->count() > 0)
                                <form action="{{ route('cliente.notificaciones.marcar-todas') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-3 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                        Marcar todas como leídas
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lista de Notificaciones -->
            <div class="space-y-4">
                @forelse(auth()->user()->notifications()->latest()->get() as $notificacion)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 
                        @if(!$notificacion->is_read) border-blue-500 bg-blue-50 @else border-gray-300 @endif">
                        <div class="p-6">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-3">
                                        <h4 class="text-lg font-medium text-gray-900">
                                            {{ $notificacion->tipo ? ucfirst(str_replace('_', ' ', $notificacion->tipo)) : 'Notificación' }}
                                        </h4>
                                        @if(!$notificacion->is_read)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                Nuevo
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <p class="mt-2 text-sm text-gray-600">
                                        {{ $notificacion->mensaje }}
                                    </p>

                                    <div class="mt-3 flex items-center text-sm text-gray-500">
                                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ $notificacion->created_at->diffForHumans() }}
                                    </div>

                                    @if($notificacion->entidad_tipo && $notificacion->entidad_id)
                                        <div class="mt-3">
                                            <a href="#" class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800">
                                                Ver detalles
                                                <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                </svg>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="ml-6 flex space-x-2">
                                    @if(!$notificacion->is_read)
                                        <form action="{{ route('cliente.notificaciones.marcar-leida', $notificacion) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center px-3 py-1 border border-gray-300 text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50">
                                                Marcar leída
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-12 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No hay notificaciones</h3>
                            <p class="mt-1 text-sm text-gray-500">
                                No tienes notificaciones en este momento.
                            </p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Tipos de Notificaciones -->
            <div class="mt-8 bg-gray-50 rounded-lg p-6">
                <h4 class="text-lg font-semibold text-gray-900 mb-4">Tipos de Notificaciones</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-blue-500 rounded-full mr-3"></div>
                        <span>Actualizaciones de estado de servicios</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-green-500 rounded-full mr-3"></div>
                        <span>Solicitudes de correcciones</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-yellow-500 rounded-full mr-3"></div>
                        <span>Recordatorios de briefs pendientes</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-red-500 rounded-full mr-3"></div>
                        <span>Alertas de vencimiento de pagos</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-purple-500 rounded-full mr-3"></div>
                        <span>Nuevos mensajes del equipo</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-indigo-500 rounded-full mr-3"></div>
                        <span>Entregas de trabajos</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>