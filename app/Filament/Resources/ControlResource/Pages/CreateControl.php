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
                        ->label('Multiple')
                        ->default(false),
                    \Filament\Forms\Components\Toggle::make('rh')
                        ->label('RH')
                        ->default(false),
                    \Filament\Forms\Components\Toggle::make('hemorragia')
                        ->label('Hemorragia')
                        ->default(false),
                    \Filament\Forms\Components\Toggle::make('vih')
                        ->label('VIH')
                        ->default(false),
                    \Filament\Forms\Components\Toggle::make('precion')
                        ->label('Presion')
                        ->default(false),
                    \Filament\Forms\Components\Toggle::make('anemia')
                        ->label('Anemia')
                        ->default(false),
                    \Filament\Forms\Components\Toggle::make('desnutricion')
                        ->label('Desnutricion')
                        ->default(false),
                    \Filament\Forms\Components\Toggle::make('dolor')
                        ->label('Dolor')
                        ->default(false),
                    \Filament\Forms\Components\Toggle::make('sintomologia')
                        ->label('Sintomologia')
                        ->default(false),
                    \Filament\Forms\Components\Toggle::make('ictericia')
                        ->label('Ictericia')
                        ->default(false),
                    \Filament\Forms\Components\Toggle::make('diabetes')
                        ->label('Diabetes')
                        ->default(false),
                    \Filament\Forms\Components\Toggle::make('renal')
                        ->label('Renal')
                        ->default(false),
                    \Filament\Forms\Components\Toggle::make('corazon')
                        ->label('Corazon')
                        ->default(false),
                    \Filament\Forms\Components\Toggle::make('hipertencion')
                        ->label('Hipertencion')
                        ->default(false),
                    \Filament\Forms\Components\Toggle::make('drogras')
                        ->label('Drogas')
                        ->default(false),
                    \Filament\Forms\Components\Toggle::make('enfermedad')
                        ->label('Enfermedad')
                        ->default(false),
                    \Filament\Forms\Components\Textarea::make('otros')
                        ->label('Otros')
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