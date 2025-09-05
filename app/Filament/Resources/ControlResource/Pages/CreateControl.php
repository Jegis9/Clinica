<?php

namespace App\Filament\Resources\ControlResource\Pages;

use App\Filament\Resources\ControlResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\HasWizard;

class CreateControl extends CreateRecord
{
    use HasWizard;
    protected static string $resource = ControlResource::class;

    protected function getSteps(): array
    {
        return [
            \Filament\Forms\Components\Wizard\Step::make('Editar datos de control')
                ->schema([
        \Filament\Forms\Components\Hidden::make('antecedente_id')
            ->default(fn () => request()->get('antecedente_id')),
                    \Filament\Forms\Components\Select::make('no_control')
                        ->label('No. de control')
                        ->options([
                            '1' => '1',
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                        ]),
                    \Filament\Forms\Components\DatePicker::make('fecha')
                        ->label('Fecha')
                        ->nullable(),
                    \Filament\Forms\Components\Toggle::make('multiple')
                        ->label('Sospecha de Embarazo Multiple')
                        ->default(false),
                    \Filament\Forms\Components\Toggle::make('rh')
                        ->label('Paciente Rh -')
                        ->default(false),
                    \Filament\Forms\Components\Toggle::make('hemorragia')
                        ->label('Hemorrragia vaginal')
                        ->default(false),
                    \Filament\Forms\Components\Toggle::make('vih')
                        ->label('VIH positivo')
                        ->default(false),
                    \Filament\Forms\Components\Toggle::make('precion')
                        ->label('Presion arterial diastoclica de 90')
                        ->default(false),
                    \Filament\Forms\Components\Toggle::make('anemia')
                        ->label('Anemia clinica')
                        ->default(false),
                    \Filament\Forms\Components\Toggle::make('desnutricion')
                        ->label('Desnutricion u obesidad')
                        ->default(false),
                    \Filament\Forms\Components\Toggle::make('dolor')
                        ->label('Dolor adominal')
                        ->default(false),
                    \Filament\Forms\Components\Toggle::make('sintomologia')
                        ->label('Sintomologia orinaria')
                        ->default(false),
                    \Filament\Forms\Components\Toggle::make('ictericia')
                        ->label('Ictericia')
                        ->default(false),
                    \Filament\Forms\Components\Toggle::make('diabetes')
                        ->label('Diabetes')
                        ->default(false),
                    \Filament\Forms\Components\Toggle::make('renal')
                        ->label('Enfermedad renal')
                        ->default(false),
                    \Filament\Forms\Components\Toggle::make('corazon')
                        ->label('Enfermedad del corazon')
                        ->default(false),
                    \Filament\Forms\Components\Toggle::make('hipertencion')
                        ->label('Hipertencion arterial')
                        ->default(false),
                    \Filament\Forms\Components\Toggle::make('drogras')
                        ->label('Consumo de drogas')
                        ->default(false),
                    \Filament\Forms\Components\Toggle::make('enfermedad')
                        ->label('Otra enfermedad')
                        ->default(false),
                    \Filament\Forms\Components\Textarea::make('otros')
                        ->label('Especifique')
                        ->rows(3)
                        ->maxLength(65535)
                        ->nullable(),
                ]),
            \Filament\Forms\Components\Wizard\Step::make('Editar seguimiento')
                ->schema([
                    \Filament\Forms\Components\Toggle::make('seguimiento_completado')
                        ->label('Seguimiento Completado')
                        ->default(false),
                    \Filament\Forms\Components\DatePicker::make('fecha_ultimo_seguimiento')
                        ->label('Fecha Ultimo Seguimiento')
                        ->nullable(),
                    \Filament\Forms\Components\DatePicker::make('fecha_proximo_seguimiento')
                        ->label('Fecha Proximo Seguimiento')
                        ->nullable(),
                    \Filament\Forms\Components\Textarea::make('observaciones_seguimiento')
                        ->label('Observaciones Seguimiento')
                        ->rows(3)
                        ->maxLength(65535)
                        ->nullable(),
                    \Filament\Forms\Components\Toggle::make('necesita_seguimiento')
                        ->label('Necesita Seguimiento')
                        ->default(false),
                ]),
        ];
    }

    // AQUÍ está el método en el lugar correcto, DENTRO de la clase
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Si viene el antecedente_id por URL, agregarlo a los datos
        if (request()->has('antecedente_id')) {
            $data['antecedente_id'] = request()->get('antecedente_id');
        }

        return $data;
    }

    // Opcional: redirigir después de crear
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}