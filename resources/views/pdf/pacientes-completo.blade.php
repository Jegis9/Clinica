<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte Completo de Pacientes</title>
    <style>
        @page { margin: 50px 30px; }
        body { 
            font-family: Arial, sans-serif; 
            font-size: 8px; /* Tamaño de fuente más pequeño */
            margin: 0;
            padding: 0;
        }
        .header { 
            text-align: center; 
            margin-bottom: 15px;
            position: fixed;
            top: -40px;
            left: 0;
            right: 0;
        }
        .header h1 { 
            margin: 0; 
            font-size: 14px; 
        }
        .header p { 
            margin: 2px 0; 
            color: #666;
            font-size: 10px;
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 50px;
            page-break-inside: auto;
        }
        th, td { 
            border: 1px solid #ddd; 
            padding: 3px; /* Padding reducido */
            text-align: left; 
            font-size: 7px; /* Fuente más pequeña */
            line-height: 1.1;
            word-wrap: break-word;
        }
        th { 
            background-color: #f8f9fa; 
            font-weight: bold;
            font-size: 7px;
            padding: 4px 3px;
        }
        tr { page-break-inside: avoid; page-break-after: auto; }
        .page-break { page-break-before: always; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        
        /* Estilos para hacer la tabla más compacta */
        .compact-table th,
        .compact-table td {
            padding: 2px 1px;
            font-size: 6.5px;
        }
        
        /* Rotar texto verticalmente si es necesario */
        .vertical-text {
            writing-mode: vertical-lr;
            transform: rotate(180deg);
            white-space: nowrap;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Reporte Completo de Pacientes - Todos los Campos</h1>
        <p>Generado el: {{ $fecha }} | Total: {{ $pacientes->count() }} registros</p>
    </div>

    <table class="compact-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Registro</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Pueblo</th>
                <th>Ocucacion</th>
                <th>Distancia a centro de salud</th>
                <th>Nombre del esposo</th>
                <th>Estado civil</th>
                <th>Documento</th>
                <th>Estado Civil</th>
                <th>Ocupación</th>
                <th>Estado civil</th>
                <th>Tiempo a centro de salud</th>
                <th>Nombre de la comunicad</th>
                <th>Telefono de emergencia</th>
                <th>Ultima regla</th>
                <th>FPP</th>
                <th>Embarazos</th>
                <th>Partos</th>
                <th>Cesarias</th>
                <th>Abortos</th>
                <th>Hijos vivos</th>
                <th>Hijos muertos</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pacientes as $paciente)
            <tr>
                <td>{{ $paciente->id }}</td>
                <td>{{ $paciente->registro_no}}</td>
                <td>{{ $paciente->nombre }}</td>
                <td>{{ $paciente->apellido }}</td>

                <td>{{ $paciente->pueblo }}</td>
                <td>{{ $paciente->ocupacion }}</td>
                <td>{{ $paciente->distancia_servicio_salud_km }}</td>
                <td>{{ $paciente->nombre_esposo }}</td>
                <td>{{ $paciente->pueblo_esposo }}</td>
                <td>{{ $paciente->ocupacion_esposo }}</td>
                <td>{{ $paciente->estado_civil }}</td>
                <td>{{$paciente->tiempo_servicio_salud_hrs}}</td>
                <td>{{$paciente->nombre_comunidad}}</td>
                <td>{{$paciente->telefono_emergencia}}</td>
                <td>{{$paciente->fecha_ultima_regla}}</td>
                <td>{{$paciente->fpp}}</td>
                <td>{{$paciente->no_embarazos}}</td>
                <td>{{$paciente->no_partos}}</td>
                <td>{{$paciente->no_cesareas}}</td>
                <td>{{$paciente->no_abortos}}</td>
                <td>{{$paciente->no_hijos_vivos}}</td>
                <td>{{$paciente->no_hijos_muertos}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>