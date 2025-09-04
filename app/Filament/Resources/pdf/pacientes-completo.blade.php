{{-- resources/views/pdf/pacientes-completo.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte Completo de Pacientes</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 18px; }
        .header p { margin: 5px 0; color: #666; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 6px; text-align: left; }
        th { background-color: #f8f9fa; font-weight: bold; }
        .text-right { text-align: right; }
        .page-break { page-break-before: always; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Reporte Completo de Pacientes</h1>
        <p>Generado el: {{ $fecha }}</p>
        <p>Total de registros: {{ $pacientes->count() }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Fecha Nac.</th>
                <th>Género</th>
                <th>Documento</th>
                <th>Estado Civil</th>
                <th>Ocupación</th>
                <!-- Agrega aquí todos los campos que tengas en tu tabla -->
            </tr>
        </thead>
        <tbody>
            @foreach($pacientes as $paciente)
            <tr>
                <td>{{ $paciente->id }}</td>
                <td>{{ $paciente->nombre }}</td>
                <td>{{ $paciente->apellido }}</td>
                <td>{{ $paciente->email }}</td>
                <td>{{ $paciente->telefono }}</td>
                <td>{{ $paciente->direccion }}</td>
                <td>{{ $paciente->fecha_nacimiento?->format('d/m/Y') }}</td>
                <td>{{ $paciente->genero }}</td>
                <td>{{ $paciente->documento }}</td>
                <td>{{ $paciente->estado_civil }}</td>
                <td>{{ $paciente->ocupacion }}</td>
                <!-- Agrega aquí todos los campos que tengas -->
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>