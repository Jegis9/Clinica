<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Historial Médico Completo</title>
    <style>
        @page { margin: 50px 30px; }
        body { 
            font-family: Arial, sans-serif; 
            font-size: 11px;
            margin: 0;
            padding: 0;
            line-height: 1.4;
        }
        .header { 
            text-align: center; 
            margin-bottom: 20px;
            border-bottom: 2px solid #2c5282;
            padding-bottom: 10px;
        }
        .header h1 { 
            margin: 0; 
            font-size: 16px; 
            color: #2c5282;
        }
        .header p { 
            margin: 2px 0; 
            color: #666;
        }
        .section {
            margin-bottom: 20px;
            page-break-inside: avoid;
        }
        .section-title {
            background-color: #2c5282;
            color: white;
            padding: 6px;
            border-radius: 3px;
            margin: 15px 0 10px 0;
            font-weight: bold;
            font-size: 12px;
        }
        .grid-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
            margin-bottom: 10px;
        }
        .data-field {
            margin-bottom: 5px;
            padding: 3px;
        }
        .data-field strong {
            color: #4a5568;
            display: inline-block;
            min-width: 120px;
        }
        .historico-item {
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            padding: 10px;
            margin-bottom: 15px;
            background-color: #f8fafc;
            page-break-inside: avoid;
        }
        .historico-header {
            background-color: #edf2f7;
            padding: 6px;
            border-radius: 2px;
            margin-bottom: 8px;
            font-weight: bold;
        }
        .no-data {
            text-align: center;
            padding: 20px;
            color: #666;
            font-style: italic;
            background-color: #f7fafc;
            border-radius: 4px;
        }
        .page-break {
            page-break-before: always;
        }
        .text-center { text-align: center; }
        .border-top {
            border-top: 1px solid #e2e8f0;
            padding-top: 10px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>HISTORIAL MÉDICO COMPLETO</h1>
        <p>Generado el: {{ $fecha }}</p>
    </div>

    @if($datosPaciente)
    <!-- SECCIÓN 1: DATOS DEL PACIENTE (UNA SOLA VEZ) -->
    <div class="section">
        <div class="section-title">DATOS GENERALES DE LA PACIENTE</div>
        
        <div class="grid-container">
            <div class="data-field"><strong>Registro No:</strong> {{ $datosPaciente->registro_no ?? 'N/A' }}</div>
            <div class="data-field"><strong>Nombre:</strong> {{ $datosPaciente->nombre }} {{ $datosPaciente->apellido }}</div>
            <div class="data-field"><strong>Fecha Nacimiento:</strong> {{ $datosPaciente->birth_date ?? 'N/A' }}</div>
                        <!-- Cálculo de edad si birth_date está disponible -->
            <div class="data-field">
            <strong>Edad:</strong> {{ \Carbon\Carbon::parse($datosPaciente->birth_date)->age }} años
            </div>
            
            <div class="data-field"><strong>Pueblo:</strong> {{ $datosPaciente->pueblo ?? 'N/A' }}</div>
            <div class="data-field"><strong>Escolaridad:</strong> {{ $datosPaciente->escolaridad ?? 'N/A' }}</div>
            <div class="data-field"><strong>Ocupación:</strong> {{ $datosPaciente->ocupacion ?? 'N/A' }}</div>
            <div class="data-field"><strong>Estado Civil:</strong> {{ $datosPaciente->estado_civil ?? 'N/A' }}</div>
            <div class="data-field"><strong>Comunidad:</strong> {{ $datosPaciente->nombre_comunidad ?? 'N/A' }}</div>
            <div class="data-field"><strong>Teléfono Emergencia:</strong> {{ $datosPaciente->telefono_emergencia ?? 'N/A' }}</div>
            <div class="data-field"><strong>Distancia Servicio:</strong> {{ $datosPaciente->distancia_servicio_salud_km ?? 'N/A' }} km</div>
            <div class="data-field"><strong>Tiempo Servicio:</strong> {{ $datosPaciente->tiempo_servicio_salud_hrs ?? 'N/A' }} hrs</div>
        </div>

    <!-- SECCIÓN 2: DATOS DEL ESPOSO (UNA SOLA VEZ) -->
    @if($datosPaciente->nombre_esposo)
        <div class="section-title">OTROS DATOS DE LA PACIENTE</div>
        <div class="grid-container">
            <div class="data-field"><strong>Nombre:</strong> {{ $datosPaciente->nombre_esposo }}</div>
            <div class="data-field"><strong>Pueblo:</strong> {{ $datosPaciente->pueblo_esposo ?? 'N/A' }}</div>
            <div class="data-field"><strong>Escolaridad:</strong> {{ $datosPaciente->escolaridad_esposo ?? 'N/A' }}</div>
            <div class="data-field"><strong>Ocupación:</strong> {{ $datosPaciente->ocupacion_esposo ?? 'N/A' }}</div>
            




        </div>
       @endif


    </div>

 
    <div class="section">
        <div class="section-title">OTROS DATOS DE EMBARAZOS PREVIOS</div>
        <div class="grid-container">
            <div class="data-field"><strong>Fecha ultima regla:</strong> {{ $datosPaciente->fecha_ultima_regla ?? 'N/A' }}</div>
            <div class="data-field"><strong>FPP:</strong> {{ $datosPaciente->fpp ?? 'N/A' }}</div>
            <div class="data-field"><strong>Embarazos:</strong> {{ $datosPaciente->no_embarazos ?? '0' }}</div>
            <div class="data-field"><strong>Partos:</strong> {{ $datosPaciente->no_partos ?? '0' }}</div>
            <div class="data-field"><strong>Cesáreas:</strong> {{ $datosPaciente->no_cesareas ?? '0' }}</div>
            <div class="data-field"><strong>Abortos:</strong> {{ $datosPaciente->no_abortos ?? '0' }}</div>
            <div class="data-field"><strong>Hijos Vivos:</strong> {{ $datosPaciente->no_hijos_vivos ?? '0' }}</div>
            <div class="data-field"><strong>Hijos Muertos:</strong> {{ $datosPaciente->no_hijos_muertos ?? '0' }}</div>
        </div>
    </div>
 

    <!-- SECCIÓN 3: ANTECEDENTES (UNA SOLA VEZ) -->
    <div class="section">
        <div class="section-title">ANTECEDENTES OBSTETRICOS</div>
        <div class="grid-container">
            <div class="data-field"><strong>Muerte:</strong> {{ $datosPaciente->muerte == 1 ? 'Si'  : ($datosPaciente->muerte == 0 ? 'No' : 'N/A') }}</div>
            <div class="data-field"><strong>Abortos:</strong> {{ $datosPaciente->abortos == 1 ? 'Si'  : ($datosPaciente->abortos == 0 ? 'No' : 'N/A') }}</div>
            <div class="data-field"><strong>Gestas:</strong> {{ $datosPaciente->gestas == 1 ? 'Si'  : ($datosPaciente->gestas == 0 ? 'No' : 'N/A') }}</div>
            <div class="data-field"><strong>Peso Bajo:</strong> {{ $datosPaciente->peso_bajo == 1 ? 'Si'  : ($datosPaciente->peso_bajo == 0 ? 'No' : 'N/A') }}</div>
            <div class="data-field"><strong>Peso:</strong> {{ $datosPaciente->pesoa == 1 ? 'Si'  : ($datosPaciente->pesoa == 0 ? 'No' : 'N/A') }}</div>
            <div class="data-field"><strong>Hipertensión:</strong> {{ $datosPaciente->hipertencion == 1 ? 'Si'  : ($datosPaciente->hipertencion == 0 ? 'No' : 'N/A') }}</div>
            <div class="data-field"><strong>Cirugías:</strong> {{ $datosPaciente->cirujias == 1 ? 'Si'  : ($datosPaciente->cirujias == 0 ? 'No' : 'N/A') }}</div>
        </div>
    </div>

<!-- SECCIÓN 4: HISTORIAL DE CONTROLES (TODAS LAS VECES) -->
<div class="section">
    <div class="section-title">HISTORIAL DE CONTROLES MÉDICOS Y SEGUIMIENTOS</div>
    
    @if($historicos->count() > 0)
        @foreach($historicos as $index => $historico)
            <!-- CADA HISTORICO EN PÁGINA SEPARADA -->
            <div class="historico-item" style="page-break-before: always;">
                <div class="historico-header">
                    Control #{{ $index + 1 }} - Fecha: {{ \Carbon\Carbon::parse($historico->fecha)->format('d/m/Y') }}
                </div>
                
                <div class="grid-container">
                    <div class="data-field"><strong>Múltiple:</strong> {{ $historico->multiple == 1 ? 'Sí' : ($historico->multiple == 0 ? 'No' : 'N/A') }}</div>
                    <div class="data-field"><strong>RH:</strong> {{ $historico->rh == 1 ? 'Si'  : ($historico->rh == 0 ? 'No' : 'N/A') }}</div>
                    <div class="data-field"><strong>Hemorragia:</strong> {{ $historico->hemorragia == 1 ? 'Sí' : ($historico->hemorragia == 0 ? 'No' : 'N/A') }}</div>
                    <div class="data-field"><strong>VIH:</strong> {{ $historico->vih == 1 ? 'Sí' : ($historico->vih == 0 ? 'No' : 'N/A') }}</div>
                    <div class="data-field"><strong>Presión:</strong> {{ $historico->precion == 1 ? 'Si'  : ($historico->precion == 0 ? 'No' : 'N/A') }}</div>
                    <div class="data-field"><strong>Anemia:</strong> {{ $historico->anemia == 1 ? 'Sí' : ($historico->anemia == 0 ? 'No' : 'N/A') }}</div>
                    <div class="data-field"><strong>Desnutrición:</strong> {{ $historico->desnutricion == 1 ? 'Sí' : ($historico->desnutricion == 0 ? 'No' : 'N/A') }}</div>
                    <div class="data-field"><strong>Dolor:</strong> {{ $historico->dolor == 1 ? 'Sí' : ($historico->dolor == 0 ? 'No' : 'N/A') }}</div>
                    <div class="data-field"><strong>Sintomatología:</strong> {{ $historico->sintomologia == 1 ? 'Sí' : ($historico->sintomologia == 0 ? 'No' : 'N/A') }}</div>
                    <div class="data-field"><strong>Ictericia:</strong> {{ $historico->ictericia == 1 ? 'Sí' : ($historico->ictericia == 0 ? 'No' : 'N/A') }}</div>
                    <div class="data-field"><strong>Diabetes:</strong> {{ $historico->diabetes == 1 ? 'Sí' : ($historico->diabetes == 0 ? 'No' : 'N/A') }}</div>
                    <div class="data-field"><strong>Renal:</strong> {{ $historico->renal == 1 ? 'Sí' : ($historico->renal == 0 ? 'No' : 'N/A') }}</div>
                    <div class="data-field"><strong>Corazón:</strong> {{ $historico->corazon == 1 ? 'Sí' : ($historico->corazon == 0 ? 'No' : 'N/A') }}</div>
                    <div class="data-field"><strong>Hipertensión:</strong> {{ $historico->historico_hipertencion == 1 ? 'Sí' : ($historico->historico_hipertencion == 0 ? 'No' : 'N/A') }}</div>
                    <div class="data-field"><strong>Drogas:</strong> {{ $historico->drogras == 1 ? 'Sí' : ($historico->drogras == 0 ? 'No' : 'N/A') }}</div>
                </div>

                @if($historico->enfermedad || $historico->otros)
                <div class="border-top">
                    @if($historico->enfermedad)
                    <div class="data-field"><strong>Enfermedad:</strong> {{ $historico->enfermedad == 1 ? 'Si'  : ($historico->enfermedad == 0 ? 'No' : 'N/A') }}</div>
                    @endif
                    @if($historico->otros)
                    <div class="data-field"><strong>Otros:</strong> {{ $historico->otros }}</div>
                    @endif
                </div>
                @endif

                @if($historico->observaciones_seguimiento)
                <div class="border-top">
                    <div class="data-field"><strong>Observaciones:</strong> {{ $historico->observaciones_seguimiento }}</div>
                </div>
                @endif

                <div class="grid-container border-top">
                    <div class="data-field"><strong>Último Seguimiento:</strong> {{ $historico->fecha_ultimo_seguimiento ?? 'N/A' }}</div>
                    <div class="data-field"><strong>Próximo Seguimiento:</strong> {{ $historico->fecha_proximo_seguimiento ?? 'N/A' }}</div>
                </div>
            </div>
        @endforeach
    @else
        <div class="no-data">
            <p>No se encontraron controles médicos</p>
        </div>
    @endif
</div>

    @else
    <div class="no-data">
        <p>No se encontraron datos para este paciente</p>
    </div>
    @endif
</body>
</html>