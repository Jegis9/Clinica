



<div class="p-6 space-y-6 bg-white rounded-lg shadow">
    @php
        use Carbon\Carbon;

        // Agrupar por mes y año
        $historicosPorMes = collect($historicos)->groupBy(function($item) {
            return Carbon::parse($item['fecha'])->format('Y-m'); // agrupamos por año-mes
        });
    @endphp

    @forelse($historicosPorMes as $mes => $registros)
        @php
            $mesCarbon = Carbon::createFromFormat('Y-m', $mes);
        @endphp

        <!-- Encabezado del mes -->
        <h2 class="text-xl font-bold text-gray-900 border-b pb-2 mb-4">
            {{ $mesCarbon->translatedFormat('F Y') }}
        </h2>

        @foreach($registros as $historico)
            @php
                $fecha = isset($historico['fecha']) ? Carbon::parse($historico['fecha']) : null;
                $fechaUltimoSeguimiento = isset($historico['fecha_ultimo_seguimiento']) ? Carbon::parse($historico['fecha_ultimo_seguimiento']) : null;
                $fechaProximoSeguimiento = isset($historico['fecha_proximo_seguimiento']) ? Carbon::parse($historico['fecha_proximo_seguimiento']) : null;
            @endphp

            <div class="p-4 mb-6 border border-gray-200 rounded-lg shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
                    Registro #{{ $loop->iteration }} - {{ $fecha ? $fecha->format('d/m/Y') : 'Sin fecha' }}
                </h3>

            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Información básica -->
                <div class="space-y-2">
                    <h4 class="font-medium text-gray-700 text-sm uppercase tracking-wide">Información Básica</h4>
                    <div class="space-y-1">
                        <p class="text-sm"><span class="font-medium text-gray-600">Control ID:</span> {{ $historico['control_id'] ?? 'N/A' }}</p>
                        <p class="text-sm"><span class="font-medium text-gray-600">No. Control:</span> {{ $historico['no_control'] ?? 'N/A' }}</p>
                        <p class="text-sm"><span class="font-medium text-gray-600">Fecha:</span> {{ $fecha ? $fecha->format('d/m/Y') : 'N/A' }}</p>
                       <p class="text-sm"><span class="font-medium text-gray-600">Dias de gestacion:</span> {{ $historico ['dias_gestacion'] ?? 'N/A'}}</p>
                       <p class="text-sm"><span class="font-medium text-gray-600">Semanas de gestacion:</span> {{ $historico ['semanas_gestacion'] ?? 'N/A' }}</p>
                       <p class="text-sm"><span class="font-medium text-gray-600">Meses de gestacion:</span> {{ $historico ['meses_gestacion'] ?? 'N/A' }}</p>
                       <p class="text-sm"><span class="font-medium text-gray-600">Dias restantes:</span> {{ $historico ['dias_restantes_fpp'] ?? 'N/A' }}</p>
                       <p class="text-sm"><span class="font-medium text-gray-600">Semanas restantes:</span> {{ $historico ['semanas_restantes_fpp'] ?? 'N/A'}}</p>

                    </div>
                </div>

                <!-- Condiciones médicas -->
                <div class="space-y-2">
                    <h4 class="font-medium text-gray-700 text-sm uppercase tracking-wide">Condiciones</h4>
                    <div class="space-y-1">
                        <p class="text-sm">
                            <span class="font-medium text-gray-600">Múltiple:</span> 
                            {{ isset($historico['multiple']) ? ($historico['multiple'] ? 'Sí' : 'No') : 'N/A' }}
                        </p>
                        <p class="text-sm">
                            <span class="font-medium text-gray-600">RH:</span> 
                            {{ isset($historico['rh']) ? ($historico['rh'] ? 'Sí' : 'No') : 'N/A' }}
                        </p>
                        <p class="text-sm">
                            <span class="font-medium text-gray-600">VIH:</span> 
                            {{ isset($historico['vih']) ? ($historico['vih'] ? 'Sí' : 'No') : 'N/A' }}
                        </p>
                    </div>
                </div>

                <!-- Síntomas -->
                <div class="space-y-2">
                    <h4 class="font-medium text-gray-700 text-sm uppercase tracking-wide">Síntomas</h4>
                    <div class="space-y-1">
                        <p class="text-sm">
                            <span class="font-medium text-gray-600">Hemorragia:</span> 
                            {{ isset($historico['hemorragia']) ? ($historico['hemorragia'] ? 'Sí' : 'No') : 'N/A' }}
                        </p>
                        <p class="text-sm">
                            <span class="font-medium text-gray-600">Presión:</span> 
                            {{ isset($historico['precion']) ? ($historico['precion'] ? 'Sí' : 'No') : 'N/A' }}
                        </p>
                        <p class="text-sm">
                            <span class="font-medium text-gray-600">Anemia:</span> 
                            {{ isset($historico['anemia']) ? ($historico['anemia'] ? 'Sí' : 'No') : 'N/A' }}
                        </p>
                    </div>
                </div>

                <!-- Más síntomas -->
                <div class="space-y-2">
                    <h4 class="font-medium text-gray-700 text-sm uppercase tracking-wide">Más Síntomas</h4>
                    <div class="space-y-1">
                        <p class="text-sm">
                            <span class="font-medium text-gray-600">Desnutrición:</span> 
                            {{ isset($historico['desnutricion']) ? ($historico['desnutricion'] ? 'Sí' : 'No') : 'N/A' }}
                        </p>
                        <p class="text-sm">
                            <span class="font-medium text-gray-600">Dolor:</span> 
                            {{ isset($historico['dolor']) ? ($historico['dolor'] ? 'Sí' : 'No') : 'N/A' }}
                        </p>
                        <p class="text-sm">
                            <span class="font-medium text-gray-600">Sintomatología:</span> 
                            {{ isset($historico['sintomologia']) ? ($historico['sintomologia'] ? 'Sí' : 'No') : 'N/A' }}
                        </p>
                    </div>
                </div>

                <!-- Enfermedades -->
                <div class="space-y-2">
                    <h4 class="font-medium text-gray-700 text-sm uppercase tracking-wide">Enfermedades</h4>
                    <div class="space-y-1">
                        <p class="text-sm">
                            <span class="font-medium text-gray-600">Ictericia:</span> 
                            {{ isset($historico['ictericia']) ? ($historico['ictericia'] ? 'Sí' : 'No') : 'N/A' }}
                        </p>
                        <p class="text-sm">
                            <span class="font-medium text-gray-600">Diabetes:</span> 
                            {{ isset($historico['diabetes']) ? ($historico['diabetes'] ? 'Sí' : 'No') : 'N/A' }}
                        </p>
                        <p class="text-sm">
                            <span class="font-medium text-gray-600">Renal:</span> 
                            {{ isset($historico['renal']) ? ($historico['renal'] ? 'Sí' : 'No') : 'N/A' }}
                        </p>
                    </div>
                </div>

                <!-- Más enfermedades -->
                <div class="space-y-2">
                    <h4 class="font-medium text-gray-700 text-sm uppercase tracking-wide">Más Enfermedades</h4>
                    <div class="space-y-1">
                        <p class="text-sm">
                            <span class="font-medium text-gray-600">Corazón:</span> 
                            {{ isset($historico['corazon']) ? ($historico['corazon'] ? 'Sí' : 'No') : 'N/A' }}
                        </p>
                        <p class="text-sm">
                            <span class="font-medium text-gray-600">Hipertensión:</span> 
                            {{ isset($historico['hipertencion']) ? ($historico['hipertencion'] ? 'Sí' : 'No') : 'N/A' }}
                        </p>
                        <p class="text-sm">
                            <span class="font-medium text-gray-600">Drogas:</span> 
                            {{ isset($historico['drogras']) ? ($historico['drogras'] ? 'Sí' : 'No') : 'N/A' }}
                        </p>
                    </div>
                </div>

                <!-- Información adicional -->
                <div class="space-y-2">
                    <h4 class="font-medium text-gray-700 text-sm uppercase tracking-wide">Información Adicional</h4>
                    <div class="space-y-1">
                        <p class="text-sm">
                            <span class="font-medium text-gray-600">Enfermedad:</span> 
                            {{ isset($historico['enfermedad']) ? ($historico['enfermedad'] ? 'Sí' : 'No') : 'N/A' }}
                        </p>
                        <p class="text-sm">
                            <span class="font-medium text-gray-600">Otros:</span> 
                            {{ $historico['otros'] ?? 'N/A' }}
                        </p>
                    </div>
                </div>

                <!-- Seguimiento -->
                <div class="space-y-2">
                    <h4 class="font-medium text-gray-700 text-sm uppercase tracking-wide">Seguimiento</h4>
                    <div class="space-y-1">
                        <p class="text-sm">
                            <span class="font-medium text-gray-600">Necesita seguimiento:</span> 
                            {{ isset($historico['necesita_seguimiento']) ? ($historico['necesita_seguimiento'] ? 'Sí' : 'No') : 'N/A' }}
                        </p>
                        <p class="text-sm">
                            <span class="font-medium text-gray-600">Seguimiento completado:</span> 
                            {{ isset($historico['seguimiento_completado']) ? ($historico['seguimiento_completado'] ? 'Sí' : 'No') : 'N/A' }}
                        </p>
                        <p class="text-sm">
                            <span class="font-medium text-gray-600">Último seguimiento:</span> 
                            {{ $fechaUltimoSeguimiento ? $fechaUltimoSeguimiento->format('d/m/Y') : 'N/A' }}
                        </p>
                        <p class="text-sm">
                            <span class="font-medium text-gray-600">Próximo seguimiento:</span> 
                            {{ $fechaProximoSeguimiento ? $fechaProximoSeguimiento->format('d/m/Y') : 'N/A' }}
                        </p>
                    </div>
                </div>

                <!-- Observaciones -->
                @if(!empty($historico['observaciones_seguimiento']))
                <div class="space-y-2 md:col-span-2 lg:col-span-3">
                    <h4 class="font-medium text-gray-700 text-sm uppercase tracking-wide">Observaciones</h4>
                    <div class="p-3 bg-gray-50 rounded-lg">
                        <p class="text-sm text-gray-700">{{ $historico['observaciones_seguimiento'] }}</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
                  </div>
        @endforeach
    @empty
        <div class="text-center py-12 text-gray-500">
            No hay registros históricos para este antecedente.
        </div>
    @endforelse
</div>