<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Completar Brief - ' . ($servicio->tipo === 'identidad_corporativa' ? 'Identidad Corporativa' : 'Community Manager')) }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Información del Servicio -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold text-blue-900 mb-2">Información del Servicio</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-blue-800">
                    <div>
                        <strong>ID Servicio:</strong> #{{ $servicio->id }}
                    </div>
                    <div>
                        <strong>Tipo:</strong> {{ $servicio->tipo === 'identidad_corporativa' ? 'Identidad Corporativa' : 'Community Manager' }}
                    </div>
                    <div>
                        <strong>Fecha Inicio:</strong> {{ $servicio->fecha_ini->format('d/m/Y') }}
                    </div>
                    <div>
                        <strong>Fecha Fin:</strong> {{ $servicio->fecha_fin->format('d/m/Y') }}
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action="#" method="POST">
                    @csrf
                    
                    <div class="p-6 space-y-8">
                        <!-- Información de la Empresa -->
                        <div class="border-b border-gray-200 pb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Información de la Empresa</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="nombre_empresa" class="block text-sm font-medium text-gray-700">Nombre de la Empresa *</label>
                                    <input type="text" id="nombre_empresa" name="nombre_empresa" required
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label for="rubro" class="block text-sm font-medium text-gray-700">Rubro/Industria *</label>
                                    <input type="text" id="rubro" name="rubro" required
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>
                                <div class="md:col-span-2">
                                    <label for="descripcion_empresa" class="block text-sm font-medium text-gray-700">Descripción de la Empresa *</label>
                                    <textarea id="descripcion_empresa" name="descripcion_empresa" rows="3" required
                                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                              placeholder="Describe qué hace tu empresa, misión, visión..."></textarea>
                                </div>
                            </div>
                        </div>

                        @if($servicio->tipo === 'identidad_corporativa')
                            <!-- Brief para Identidad Corporativa -->
                            <div class="border-b border-gray-200 pb-8">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Identidad Corporativa</h3>
                                <div class="space-y-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-3">Estilo Deseado *</label>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            @foreach(['moderno', 'clasico', 'minimalista', 'elegante', 'juvenil', 'corporativo'] as $estilo)
                                                <label class="flex items-center">
                                                    <input type="radio" name="estilo" value="{{ $estilo }}" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300">
                                                    <span class="ml-2 text-sm text-gray-700 capitalize">{{ $estilo }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div>
                                        <label for="colores" class="block text-sm font-medium text-gray-700">Colores Preferidos</label>
                                        <input type="text" id="colores" name="colores"
                                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                               placeholder="Ej: Azul corporativo, naranja energético...">
                                    </div>

                                    <div>
                                        <label for="referencias" class="block text-sm font-medium text-gray-700">Referencias o Inspiración</label>
                                        <textarea id="referencias" name="referencias" rows="3"
                                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                  placeholder="Links, ejemplos de logos que te gustan..."></textarea>
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- Brief para Community Manager -->
                            <div class="border-b border-gray-200 pb-8">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Community Manager</h3>
                                <div class="space-y-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-3">Redes Sociales Objetivo *</label>
                                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                            @foreach(['instagram', 'facebook', 'linkedin', 'twitter', 'tiktok', 'youtube', 'pinterest', 'otras'] as $red)
                                                <label class="flex items-center">
                                                    <input type="checkbox" name="redes_sociales[]" value="{{ $red }}" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                                                    <span class="ml-2 text-sm text-gray-700 capitalize">{{ $red }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div>
                                        <label for="objetivos" class="block text-sm font-medium text-gray-700">Objetivos del CM *</label>
                                        <textarea id="objetivos" name="objetivos" rows="3" required
                                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                  placeholder="¿Qué esperas lograr con la gestión de redes sociales?"></textarea>
                                    </div>

                                    <div>
                                        <label for="publico_objetivo" class="block text-sm font-medium text-gray-700">Público Objetivo *</label>
                                        <textarea id="publico_objetivo" name="publico_objetivo" rows="2" required
                                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                  placeholder="Edad, intereses, ubicación..."></textarea>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Información Adicional -->
                        <div class="border-b border-gray-200 pb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Información Adicional</h3>
                            <div class="space-y-6">
                                <div>
                                    <label for="competencia" class="block text-sm font-medium text-gray-700">Competencia Directa</label>
                                    <textarea id="competencia" name="competencia" rows="2"
                                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                              placeholder="Menciona algunas empresas similares a la tuya..."></textarea>
                                </div>

                                <div>
                                    <label for="elementos_importantes" class="block text-sm font-medium text-gray-700">Elementos Importantes a Destacar</label>
                                    <textarea id="elementos_importantes" name="elementos_importantes" rows="2"
                                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                              placeholder="¿Qué aspectos de tu empresa quieres que se comuniquen?"></textarea>
                                </div>

                                <div>
                                    <label for="comentarios_adicionales" class="block text-sm font-medium text-gray-700">Comentarios Adicionales</label>
                                    <textarea id="comentarios_adicionales" name="comentarios_adicionales" rows="3"
                                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                              placeholder="Cualquier información adicional que consideres relevante..."></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Adjuntar Documentos -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Documentos Adjuntos</h3>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="mt-4">
                                    <label for="documentos" class="cursor-pointer">
                                        <span class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                            <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                            </svg>
                                            Subir Documentos
                                        </span>
                                        <input id="documentos" name="documentos[]" type="file" multiple class="hidden">
                                    </label>
                                    <p class="text-xs text-gray-500 mt-2">
                                        PNG, JPG, PDF hasta 10MB (Opcional)
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Botones de Acción -->
                        <div class="flex justify-end space-x-4 pt-6">
                            <a href="{{ route('cliente.briefs') }}" 
                               class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Cancelar
                            </a>
                            <button type="submit" 
                                    class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Enviar Brief
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Información de Ayuda -->
            <div class="mt-6 bg-green-50 border border-green-200 rounded-lg p-6">
                <h4 class="text-md font-semibold text-green-900 mb-2">¿Necesitas ayuda?</h4>
                <p class="text-sm text-green-800">
                    Si tienes dudas sobre cómo completar el brief, puedes contactar a nuestro equipo de soporte.
                    Mientras más detallada sea tu información, mejor podremos entender tus necesidades y expectativas.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>