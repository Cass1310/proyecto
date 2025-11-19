<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis Briefs') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Alertas de Briefs Pendientes -->
            @if(auth()->user()->serviciosPendientesBrief()->count() > 0)
                <div class="mb-6 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-yellow-800">
                                Tienes {{ auth()->user()->serviciosPendientesBrief()->count() }} briefs pendientes por completar
                            </h3>
                            <p class="text-sm text-yellow-700 mt-1">
                                Completa los briefs pendientes para iniciar el desarrollo de tus servicios.
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Briefs Pendientes -->
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Briefs Pendientes</h3>
                        </div>
                        <div class="divide-y divide-gray-200">
                            @forelse(auth()->user()->serviciosPendientesBrief()->get() as $servicio)
                                <div class="p-6 hover:bg-gray-50">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <h4 class="text-lg font-medium text-gray-900">
                                                {{ $servicio->tipo === 'identidad_corporativa' ? 'Identidad Corporativa' : 'Community Manager' }}
                                            </h4>
                                            <p class="text-sm text-gray-500 mt-1">
                                                <strong>Servicio ID:</strong> #{{ $servicio->id }} | 
                                                <strong>Contratado:</strong> {{ $servicio->created_at->format('d/m/Y') }}
                                            </p>
                                            <p class="text-sm text-gray-500">
                                                <strong>Fecha límite:</strong> 
                                                {{ $servicio->created_at->addDays(7)->format('d/m/Y') }}
                                                <span class="text-red-600 ml-2">(Urgente)</span>
                                            </p>
                                        </div>
                                        <div class="ml-6">
                                            <a href="{{ route('cliente.briefs.crear', $servicio) }}" 
                                               class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                Completar Brief
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="p-6 text-center text-gray-500">
                                    No tienes briefs pendientes.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Información sobre Briefs -->
                <div class="space-y-6">
                    <!-- Tarjeta de Información -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                        <h4 class="text-lg font-semibold text-blue-900 mb-3">¿Qué es un Brief?</h4>
                        <p class="text-sm text-blue-800 mb-4">
                            El brief es un cuestionario esencial que nos ayuda a entender tus necesidades y expectativas para tu proyecto.
                        </p>
                        <ul class="text-sm text-blue-800 space-y-2">
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-blue-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Proporciona información clave sobre tu empresa</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-blue-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Define el estilo y dirección creativa</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-blue-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Establece plazos y expectativas</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Briefs Completados -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-4 border-b border-gray-200">
                            <h4 class="text-md font-semibold text-gray-900">Briefs Completados</h4>
                        </div>
                        <div class="p-4">
                            <div class="text-center">
                                <p class="text-2xl font-bold text-gray-900">
                                    {{ auth()->user()->briefsComoCliente()->count() }}
                                </p>
                                <p class="text-sm text-gray-500">Total completados</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Briefs Completados (Historial) -->
            <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Historial de Briefs Completados</h3>
                </div>
                <div class="divide-y divide-gray-200">
                    @forelse(auth()->user()->briefsComoCliente()->with('servicio')->get() as $brief)
                        <div class="p-6 hover:bg-gray-50">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h4 class="text-lg font-medium text-gray-900">
                                        {{ $brief->servicio->tipo === 'identidad_corporativa' ? 'Identidad Corporativa' : 'Community Manager' }}
                                    </h4>
                                    <p class="text-sm text-gray-500 mt-1">
                                        <strong>Tipo de Brief:</strong> {{ strtoupper($brief->tipo) }} | 
                                        <strong>Completado:</strong> {{ $brief->fecha_recibida->format('d/m/Y H:i') }}
                                    </p>
                                    @if($brief->document_path)
                                        <p class="text-sm text-green-600 mt-1">
                                            <svg class="h-4 w-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            Documento adjunto
                                        </p>
                                    @endif
                                </div>
                                <div class="ml-6 flex space-x-2">
                                    <a href="{{ route('cliente.servicios.show', $brief->servicio) }}" 
                                       class="inline-flex items-center px-3 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                        Ver Servicio
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-6 text-center text-gray-500">
                            No has completado ningún brief aún.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>