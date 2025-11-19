<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis Servicios') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-900">Todos mis servicios</h3>
                        <div class="flex space-x-2">
                            <select class="border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="all">Todos los estados</option>
                                <option value="activo">Activos</option>
                                <option value="culminado">Culminados</option>
                                <option value="cancelado">Cancelados</option>
                            </select>
                            <select class="border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="all">Todos los tipos</option>
                                <option value="identidad_corporativa">Identidad Corporativa</option>
                                <option value="community_manager">Community Manager</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="divide-y divide-gray-200">
                    @forelse(auth()->user()->serviciosComoCliente()->with(['brief', 'logos', 'publicationCalendars'])->get() as $servicio)
                        <div class="p-6 hover:bg-gray-50">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-3">
                                        <h4 class="text-lg font-medium text-gray-900">
                                            {{ $servicio->tipo === 'identidad_corporativa' ? 'Identidad Corporativa' : 'Community Manager' }}
                                        </h4>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                            @if($servicio->estado === 'activo') bg-green-100 text-green-800
                                            @elseif($servicio->estado === 'culminado') bg-blue-100 text-blue-800
                                            @else bg-red-100 text-red-800 @endif">
                                            {{ ucfirst($servicio->estado) }}
                                        </span>
                                    </div>
                                    
                                    <p class="text-sm text-gray-500 mt-1">
                                        <strong>Periodo:</strong> {{ $servicio->fecha_ini->format('d/m/Y') }} - {{ $servicio->fecha_fin->format('d/m/Y') }}
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        <strong>Costo:</strong> ${{ number_format($servicio->costo, 2) }}
                                    </p>

                                    <!-- Progreso -->
                                    <div class="mt-3">
                                        <div class="flex justify-between text-sm text-gray-600 mb-1">
                                            <span>Progreso</span>
                                            <span>{{ number_format($servicio->progreso, 0) }}%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-green-600 h-2 rounded-full" style="width: {{ $servicio->progreso }}%"></div>
                                        </div>
                                    </div>

                                    <!-- Detalles específicos del servicio -->
                                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                        @if($servicio->tipo === 'identidad_corporativa')
                                            <div>
                                                <span class="font-medium">Brief:</span>
                                                @if($servicio->brief)
                                                    <span class="text-green-600">Completado</span>
                                                @else
                                                    <span class="text-red-600">Pendiente</span>
                                                @endif
                                            </div>
                                            <div>
                                                <span class="font-medium">Logo:</span>
                                                @php
                                                    $logo = $servicio->logos()->latest()->first();
                                                @endphp
                                                @if($logo)
                                                    <span class="text-{{ $logo->estado === 'entregado' ? 'green' : 'yellow' }}-600 capitalize">{{ $logo->estado }}</span>
                                                @else
                                                    <span class="text-gray-500">En espera</span>
                                                @endif
                                            </div>
                                            <div>
                                                <span class="font-medium">Manual:</span>
                                                @if($servicio->manuals()->exists())
                                                    <span class="text-green-600">Entregado</span>
                                                @else
                                                    <span class="text-gray-500">Pendiente</span>
                                                @endif
                                            </div>
                                        @else
                                            <div>
                                                <span class="font-medium">Brief:</span>
                                                @if($servicio->brief)
                                                    <span class="text-green-600">Completado</span>
                                                @else
                                                    <span class="text-red-600">Pendiente</span>
                                                @endif
                                            </div>
                                            <div>
                                                <span class="font-medium">Calendario:</span>
                                                @php
                                                    $calendario = $servicio->publicationCalendars()->latest()->first();
                                                @endphp
                                                @if($calendario)
                                                    <span class="text-{{ $calendario->estado === 'entregado' ? 'green' : 'yellow' }}-600 capitalize">{{ $calendario->estado }}</span>
                                                @else
                                                    <span class="text-gray-500">En espera</span>
                                                @endif
                                            </div>
                                            <div>
                                                <span class="font-medium">Artes:</span>
                                                @php
                                                    $artesCount = $servicio->publicationCalendars()->withCount('artworks')->get()->sum('artworks_count');
                                                @endphp
                                                <span class="text-gray-600">{{ $artesCount }} creados</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="ml-6 flex space-x-2">
                                    @if(!$servicio->brief)
                                        <a href="{{ route('cliente.briefs.crear', $servicio) }}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                            Completar Brief
                                        </a>
                                    @endif
                                    <a href="{{ route('cliente.servicios.show', $servicio) }}" class="inline-flex items-center px-3 py-2 border border-gray-300 text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                        Ver Detalles
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-6 text-center text-gray-500">
                            No tienes servicios contratados.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>