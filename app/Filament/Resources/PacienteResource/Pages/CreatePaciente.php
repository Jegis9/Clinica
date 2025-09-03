<?php

namespace App\Filament\Resources\PacienteResource\Pages;

use App\Filament\Resources\PacienteResource;
use App\Filament\Resources\AntobsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\HasWizard;

class CreatePaciente extends CreateRecord
{
    use HasWizard;
    protected static string $resource = PacienteResource::class;

        protected function getSteps(): array
    {
        return [
            \Filament\Forms\Components\Wizard\Step::make('Datos de embarazada')
                ->schema([
                    \Filament\Forms\Components\TextInput::make('registro_no')
                        ->label('Registro No')
                        ->maxLength(255)
                        ->nullable(),
                    \Filament\Forms\Components\TextInput::make('nombre')
                        ->label('Nombre')
                        ->maxLength(255)
                        ->nullable(),
                    \Filament\Forms\Components\TextInput::make('apellido')
                        ->label('Apellido')
                        ->maxLength(255)
                        ->nullable(),
                    \Filament\Forms\Components\DatePicker::make('birth_date')
                        ->label('Fecha de nacimiento')
                        ->nullable(),
                    \Filament\Forms\Components\TextInput::make('pueblo')
                        ->label('Pueblo')
                        ->maxLength(255)
                        ->nullable(),
                    \Filament\Forms\Components\TextInput::make('escolaridad')
                        ->label('Escolaridad')
                        ->maxLength(255)
                        ->nullable(),
                    \Filament\Forms\Components\Select::make('estado_civil')
                        ->label('Estado civil')
                        ->options([
                            'soltera' => 'Soltera',
                            'casada' => 'Casada',
                            'union_libre' => 'Unión libre',
                            'divorciada' => 'Divorciada',
                            'viuda' => 'Viuda',
                        ])
                        ->nullable(),
                    \Filament\Forms\Components\TextInput::make('ocupacion')
                        ->label('Ocupación')
                        ->maxLength(255)
                        ->nullable(),
                ]),
            \Filament\Forms\Components\Wizard\Step::make('Datos del esposo')
                ->schema([
                    \Filament\Forms\Components\TextInput::make('nombre_esposo')
                        ->label('Nombre del esposo')
                        ->maxLength(255)
                        ->nullable(),
                    \Filament\Forms\Components\TextInput::make('pueblo_esposo')
                        ->label('Pueblo del esposo')
                        ->maxLength(255)
                        ->nullable(),
                    \Filament\Forms\Components\TextInput::make('escolaridad_esposo')
                        ->label('Escolaridad del esposo')
                        ->maxLength(255)
                        ->nullable(),
                    \Filament\Forms\Components\TextInput::make('ocupacion_esposo')
                        ->label('Ocupación del esposo')
                        ->maxLength(255)
                        ->nullable(),
                ]),
            \Filament\Forms\Components\Wizard\Step::make('Datos generales')
                ->schema([
                    \Filament\Forms\Components\TextInput::make('distancia_servicio_salud_km')
                        ->label('Distancia a servicio de salud (km)')
                        ->numeric()
                        ->nullable(),
                    \Filament\Forms\Components\TextInput::make('tiempo_servicio_salud_hrs')
                        ->label('Tiempo a servicio de salud (hrs)')
                        ->numeric()
                        ->nullable(),
                    \Filament\Forms\Components\TextInput::make('nombre_comunidad')
                        ->label('Nombre de la comunidad')
                        ->maxLength(255)
                        ->nullable(),
                    \Filament\Forms\Components\TextInput::make('telefono_emergencia')
                        ->label('Teléfono de emergencia')
                        ->maxLength(255)
                        ->nullable(),
                    \Filament\Forms\Components\DatePicker::make('fecha_ultima_regla')
                        ->label('Fecha última regla')
                        ->nullable(),
                    \Filament\Forms\Components\DatePicker::make('fpp')
                        ->label('FPP')
                        ->nullable(),
                    \Filament\Forms\Components\TextInput::make('no_embarazos')
                        ->label('No. embarazos')
                        ->numeric()
                        ->default(0),
                    \Filament\Forms\Components\TextInput::make('no_partos')
                        ->label('No. partos')
                        ->numeric()
                        ->default(0),
                    \Filament\Forms\Components\TextInput::make('no_cesareas')
                        ->label('No. cesáreas')
                        ->numeric()
                        ->default(0),
                    \Filament\Forms\Components\TextInput::make('no_abortos')
                        ->label('No. abortos')
                        ->numeric()
                        ->default(0),
                ]),
        ];
    }

    protected function getRedirectUrl(): string
    {
        // Después de crear paciente, redirigir a crear control prenatal
        return AntobsResource::getUrl('create', [
            'patient_id' => $this->record->id
        ]);

    }



}
