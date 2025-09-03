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
                        ->required(),
                    \Filament\Forms\Components\TextInput::make('nombre')
                        ->label('Nombre')
                        ->maxLength(255)
                        ->required()
                        ->rules(['regex:/^[\p{L}\s]+$/u'])
                        ->validationMessages([
                            'regex' => 'El nombre solo puede contener letras y espacios',
                        ]),
                    \Filament\Forms\Components\TextInput::make('apellido')
                        ->label('Apellido')
                        ->maxLength(255)
                        ->required()
                        ->rules(['regex:/^[\p{L}\s]+$/u'])
                        ->validationMessages([
                            'regex' => 'El apellido solo puede contener letras y espacios',
                        ]),
                    \Filament\Forms\Components\DatePicker::make('birth_date')
                        ->label('Fecha de nacimiento')
                        ->required(),
                    
                    \Filament\Forms\Components\TextInput::make('pueblo')
                        ->label('Pueblo')
                        ->maxLength(255)
                        ->required()
                        ->rules(['regex:/^[\p{L}\s]+$/u'])
                        ->validationMessages([
                            'regex' => 'El Pueblo solo puede contener letras y espacios',
                        ]),
                    \Filament\Forms\Components\TextInput::make('escolaridad')
                        ->label('Escolaridad')
                        ->maxLength(255)
                        ->required()
                        ->rules(['regex:/^[\p{L}\s]+$/u'])
                        ->validationMessages([
                            'regex' => 'La escolaridad solo puede contener letras y espacios',
                        ]),

                    \Filament\Forms\Components\Select::make('estado_civil')
                        ->label('Estado civil')
                        ->options([
                            'soltera' => 'Soltera',
                            'casada' => 'Casada',
                            'union_libre' => 'Unión libre',
                            'divorciada' => 'Divorciada',
                            'viuda' => 'Viuda',
                        ])
                        ->required(),
                        
                    \Filament\Forms\Components\TextInput::make('ocupacion')
                        ->label('Ocupación')
                        ->maxLength(255)
                        ->required()
                        ->rules(['regex:/^[\p{L}\s]+$/u'])
                        ->validationMessages([
                            'regex' => 'La ocupación solo puede contener letras y espacios',
                        ]),
                ]),
            \Filament\Forms\Components\Wizard\Step::make('Datos del esposo')
                ->schema([
                    \Filament\Forms\Components\TextInput::make('nombre_esposo')
                        ->label('Nombre del esposo')
                        ->maxLength(255)
                        ->required()
                        ->rules(['regex:/^[\p{L}\s]+$/u'])
                        ->validationMessages([
                            'regex' => 'El nombre del esposo solo puede contener letras y espacios',
                        ]),
                    \Filament\Forms\Components\TextInput::make('pueblo_esposo')
                        ->label('Pueblo del esposo')
                        ->maxLength(255)
                        ->required()
                        ->rules(['regex:/^[\p{L}\s]+$/u'])
                        ->validationMessages([
                            'regex' => 'El pueblo del esposo solo puede contener letras y espacios',
                        ]),
                    \Filament\Forms\Components\TextInput::make('escolaridad_esposo')
                        ->label('Escolaridad del esposo')
                        ->maxLength(255)
                        ->required()
                        ->rules(['regex:/^[\p{L}\s]+$/u'])
                        ->validationMessages([
                            'regex' => 'La escolaridad del esposo solo puede contener letras y espacios',
                        ]),
                    \Filament\Forms\Components\TextInput::make('ocupacion_esposo')
                        ->label('Ocupación del esposo')
                        ->maxLength(255)
                        ->required()
                        ->rules(['regex:/^[\p{L}\s]+$/u'])
                        ->validationMessages([
                            'regex' => 'La ocupación del esposo solo puede contener letras y espacios',
                        ]),
                ]),
            \Filament\Forms\Components\Wizard\Step::make('Datos generales')
                ->schema([
                    \Filament\Forms\Components\TextInput::make('distancia_servicio_salud_km')
                        ->label('Distancia a servicio de salud (km)')
                        ->numeric()
                        ->required()
                        ->rules(['regex:/^[0-9]+$/'])
                        ->validationMessages([
                            'regex' => 'La distancia solo puede contener números',
                        ]),
                    \Filament\Forms\Components\TextInput::make('tiempo_servicio_salud_hrs')
                        ->label('Tiempo a servicio de salud (hrs)')
                        ->numeric()
                        ->required()
                        ->rules(['regex:/^[0-9]+$/'])
                        ->validationMessages([
                            'regex' => 'El tiempo solo puede contener números',
                        ]),
                    \Filament\Forms\Components\TextInput::make('nombre_comunidad')
                        ->label('Nombre de la comunidad')
                        ->maxLength(255)
                        ->required()
                        ->rules(['regex:/^[\p{L}\s]+$/u'])
                        ->validationMessages([
                            'regex' => 'El nombre de la comunidad solo puede contener letras y espacios',
                        ]),
                    \Filament\Forms\Components\TextInput::make('telefono_emergencia')
                        ->label('Teléfono de emergencia')
                        ->maxLength(255)
                        ->required()
                        ->rules(['regex:/^[0-9]+$/'])
                        ->validationMessages([
                            'regex' => 'El teléfono de emergencia solo puede contener números',
                        ]),
                    \Filament\Forms\Components\DatePicker::make('fecha_ultima_regla')
                        ->label('Fecha última regla')
                        ->required(),
                   
                    \Filament\Forms\Components\DatePicker::make('fpp')
                        ->label('FPP')
                        ->required(),
                     
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
