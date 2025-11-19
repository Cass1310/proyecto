<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard - Cliente') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Alertas y Notificaciones -->
            @if(auth()->user()->notificacionesNoLeidas()->count() > 0)
                <div class="mb-6 bg-yellow-50 border-l-4 border-yellow-400 p-4">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-yellow-400 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        <p class="ml-3 text-sm text-yellow-700">
                            Tienes <a href="{{ route('cliente.notificaciones') }}" class="underline font-medium">{{ auth()->user()->notificacionesNoLeidas()->count() }} notificaciones sin leer</a>
                        </p>
                    </div>
                </div>
            @endif

            <!-- Briefs Pendientes -->
            @if(auth()->user()->serviciosPendientesBrief()->count() > 0)
                <div class="mb-6 bg-blue-50 border-l-4 border-blue-400 p-4">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-blue-400 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                        <p class="ml-3 text-sm text-blue-700">
                            Tienes <a href="{{ route('cliente.briefs') }}" class="underline font-medium">{{ auth()->user()->serviciosPendientesBrief()->count() }} briefs pendientes</a> por completar
                        </p>
                    </div>
                </div>
            @endif

            <!-- Estadísticas Rápidas -->
            <div class="flex flex-wrap gap-6 mb-8">
                @php
                    $stats = [
                        ['count' => auth()->user()->serviciosActivos()->count(), 'label' => 'Servicios Activos', 'color' => 'green', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />'],
                        ['count' => auth()->user()->serviciosPendientesBrief()->count(), 'label' => 'Briefs Pendientes', 'color' => 'blue', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />'],
                        ['count' => auth()->user()->notificacionesNoLeidas()->count(), 'label' => 'Notificaciones', 'color' => 'yellow', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />'],
                    ];
                @endphp

                @foreach($stats as $stat)
                    <div class="flex-1 bg-white shadow-sm sm:rounded-lg min-w-[200px]">
                        <div class="p-6 flex items-center">
                            <div class="flex-shrink-0 bg-{{ $stat['color'] }}-100 rounded-md p-3">
                                <svg class="h-6 w-6 text-{{ $stat['color'] }}-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    {!! $stat['icon'] !!}
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">{{ $stat['label'] }}</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $stat['count'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


            <!-- Servicios Activos -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8 mt-6">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Mis Servicios Activos</h3>
                </div>
                <div class="divide-y divide-gray-200">
                    @forelse(auth()->user()->serviciosActivos()->with('brief')->get() as $servicio)
                        <div class="p-6">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h4 class="text-lg font-medium text-gray-900">
                                        {{ $servicio->tipo === 'identidad_corporativa' ? 'Identidad Corporativa' : 'Community Manager' }}
                                    </h4>
                                    <p class="text-sm text-gray-500 mt-1">
                                        Fecha inicio: {{ $servicio->fecha_ini->format('d/m/Y') }} | 
                                        Fecha fin: {{ $servicio->fecha_fin->format('d/m/Y') }}
                                    </p>
                                    
                                    <!-- Barra de Progreso -->
                                    <div class="mt-4">
                                        <div class="flex justify-between text-sm text-gray-600 mb-1">
                                            <span>Progreso del servicio</span>
                                            <span>{{ number_format($servicio->progreso, 0) }}%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-green-600 h-2 rounded-full" style="width: {{ $servicio->progreso }}%"></div>
                                        </div>
                                    </div>

                                    <!-- Estados específicos -->
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
                                                @php $logo = $servicio->logos()->latest()->first(); @endphp
                                                @if($logo)
                                                    <span class="text-{{ $logo->estado === 'entregado' ? 'green' : 'yellow' }}-600 capitalize">{{ $logo->estado }}</span>
                                                @else
                                                    <span class="text-gray-500">En espera</span>
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
                                                @php $calendario = $servicio->publicationCalendars()->latest()->first(); @endphp
                                                @if($calendario)
                                                    <span class="text-{{ $calendario->estado === 'entregado' ? 'green' : 'yellow' }}-600 capitalize">{{ $calendario->estado }}</span>
                                                @else
                                                    <span class="text-gray-500">En espera</span>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="ml-6 flex space-x-2">
                                    @if(!$servicio->brief)
                                        <a href="{{ route('cliente.briefs.crear', $servicio) }}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            Completar Brief
                                        </a>
                                    @endif
                                    <a href="{{ route('cliente.servicios.show', $servicio) }}" class="inline-flex items-center px-3 py-2 border border-gray-300 text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        Ver Detalles
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-6 text-center text-gray-500">
                            No tienes servicios activos en este momento.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Acciones Rápidas -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Acciones Rápidas</h3>
                </div>
                <div class="p-6 flex space-x-4 overflow-x-auto">
                    @php
                        $acciones = [
                            ['route'=>'cliente.servicios','label'=>'Mis Servicios','color'=>'blue','icon'=>'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
                            ['route'=>'cliente.briefs','label'=>'Briefs','color'=>'green','icon'=>'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                            ['route'=>'cliente.pagos','label'=>'Pagos','color'=>'yellow','icon'=>'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1'],
                            ['route'=>'cliente.notificaciones','label'=>'Notificaciones','color'=>'purple','icon'=>'M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9'],
                        ];
                    @endphp

                    @foreach($acciones as $accion)
                        <a href="{{ route($accion['route']) }}" class="flex items-center space-x-2 px-4 py-2 border-2 border-gray-200 rounded-lg hover:border-{{ $accion['color'] }}-500 hover:bg-{{ $accion['color'] }}-50 transition-colors min-w-max">
                            <svg class="h-6 w-6 text-{{ $accion['color'] }}-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $accion['icon'] }}" />
                            </svg>
                            <span class="text-sm font-medium text-gray-900">{{ $accion['label'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
