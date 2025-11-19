<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis Pagos') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Resumen de Pagos -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-blue-100 rounded-md p-3">
                                <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Pagado</p>
                                <p class="text-2xl font-semibold text-gray-900">
                                    ${{ number_format(auth()->user()->pagosComoCliente()->where('estado', 'pagado')->sum('cantidad'), 2) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-yellow-100 rounded-md p-3">
                                <svg class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Pendientes</p>
                                <p class="text-2xl font-semibold text-gray-900">
                                    ${{ number_format(auth()->user()->pagosComoCliente()->where('estado', 'pendiente')->sum('cantidad'), 2) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-green-100 rounded-md p-3">
                                <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Revisados</p>
                                <p class="text-2xl font-semibold text-gray-900">
                                    {{ auth()->user()->pagosComoCliente()->where('estado', 'revisado')->count() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-gray-100 rounded-md p-3">
                                <svg class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Próximo Pago</p>
                                <p class="text-lg font-semibold text-gray-900">
                                    @php
                                        $proximoPago = auth()->user()->pagosComoCliente()
                                            ->where('estado', 'pendiente')
                                            ->where('fecha_pago', '>=', now())
                                            ->orderBy('fecha_pago')
                                            ->first();
                                    @endphp
                                    @if($proximoPago)
                                        {{ $proximoPago->fecha_pago->format('d/m') }}
                                    @else
                                        -
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lista de Pagos -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-900">Historial de Pagos</h3>
                        <div class="flex space-x-2">
                            <select class="border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                                <option value="all">Todos los estados</option>
                                <option value="pendiente">Pendientes</option>
                                <option value="pagado">Pagados</option>
                                <option value="revisado">Revisados</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="divide-y divide-gray-200">
                    @forelse(auth()->user()->pagosComoCliente()->with('servicio')->latest()->get() as $pago)
                        <div class="p-6 hover:bg-gray-50">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-3">
                                        <h4 class="text-lg font-medium text-gray-900">
                                            Pago #{{ $pago->id }}
                                        </h4>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                            @if($pago->estado === 'pagado') bg-green-100 text-green-800
                                            @elseif($pago->estado === 'pendiente') bg-yellow-100 text-yellow-800
                                            @else bg-blue-100 text-blue-800 @endif">
                                            {{ ucfirst($pago->estado) }}
                                        </span>
                                    </div>
                                    
                                    <div class="mt-2 grid grid-cols-1 md:grid-cols-3 gap-4 text-sm text-gray-600">
                                        <div>
                                            <strong>Servicio:</strong> 
                                            {{ $pago->servicio->tipo === 'identidad_corporativa' ? 'Identidad Corporativa' : 'Community Manager' }}
                                        </div>
                                        <div>
                                            <strong>Fecha:</strong> {{ $pago->fecha_pago->format('d/m/Y H:i') }}
                                        </div>
                                        <div>
                                            <strong>Tipo:</strong> {{ ucfirst($pago->tipo) }}
                                        </div>
                                        <div>
                                            <strong>Monto:</strong> 
                                            <span class="font-semibold text-gray-900">${{ number_format($pago->cantidad, 2) }}</span>
                                        </div>
                                        <div>
                                            <strong>Método:</strong> Transferencia
                                        </div>
                                        @if($pago->comprobante_path)
                                            <div>
                                                <strong>Comprobante:</strong> 
                                                <a href="#" class="text-blue-600 hover:text-blue-800">Descargar</a>
                                            </div>
                                        @endif
                                    </div>

                                    @if($pago->estado === 'pendiente' && $pago->fecha_pago <= now()->addDays(3))
                                        <div class="mt-3 bg-red-50 border border-red-200 rounded-md p-3">
                                            <div class="flex items-center">
                                                <svg class="h-5 w-5 text-red-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                </svg>
                                                <span class="text-sm text-red-700">
                                                    @if($pago->fecha_pago < now())
                                                        Vencido
                                                    @else
                                                        Vence en {{ $pago->fecha_pago->diffInDays(now()) }} días
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="ml-6 flex space-x-2">
                                    @if($pago->estado === 'pendiente')
                                        <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            Realizar Pago
                                        </button>
                                    @endif
                                    @if($pago->comprobante_path)
                                        <a href="#" class="inline-flex items-center px-3 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                            Ver Comprobante
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-6 text-center text-gray-500">
                            No tienes pagos registrados.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Información de Pagos -->
            <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Métodos de Pago -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Métodos de Pago Aceptados</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <span class="text-blue-600 font-semibold">T</span>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-900">Transferencia Bancaria</p>
                                        <p class="text-sm text-gray-500">BBVA, BCP, Interbank</p>
                                    </div>
                                </div>
                                <span class="text-green-600 text-sm font-medium">Disponible</span>
                            </div>

                            <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                                        <span class="text-yellow-600 font-semibold">Y</span>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-900">Yape / Plin</p>
                                        <p class="text-sm text-gray-500">Pago inmediato</p>
                                    </div>
                                </div>
                                <span class="text-green-600 text-sm font-medium">Disponible</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Próximos Pagos -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Próximos Vencimientos</h3>
                    </div>
                    <div class="p-6">
                        @php
                            $proximosPagos = auth()->user()->pagosComoCliente()
                                ->where('estado', 'pendiente')
                                ->where('fecha_pago', '>=', now())
                                ->orderBy('fecha_pago')
                                ->take(3)
                                ->get();
                        @endphp
                        
                        @forelse($proximosPagos as $pago)
                            <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-b-0">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">
                                        {{ $pago->servicio->tipo === 'identidad_corporativa' ? 'Identidad Corporativa' : 'Community Manager' }}
                                    </p>
                                    <p class="text-sm text-gray-500">Vence {{ $pago->fecha_pago->format('d/m/Y') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-semibold text-gray-900">${{ number_format($pago->cantidad, 2) }}</p>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Pendiente
                                    </span>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500 text-center py-4">No hay pagos pendientes</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>