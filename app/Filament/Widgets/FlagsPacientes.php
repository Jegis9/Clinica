<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Filament\Resources\ControlResource;

class FlagsPacientes extends BaseWidget
{

    protected static ?string $heading = 'Pacientes con seguimiento pendiente';
    protected static ?int $sort = 4;
    protected int | string | array $columnSpan = 'full';


    public function table(Table $table): Table
    {
        return $table
            ->query(
            \App\Models\FollowUpDashboard::query()
                

    
                )
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID')->sortable(),
                Tables\Columns\TextColumn::make('nombre')->label('Nombre')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('apellido')->label('Apellido')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('telefono_emergencia')->label('Telefono de emergencia')->sortable(),
                Tables\Columns\TextColumn::make('estado_seguimiento')
                    ->label('Estado')
                    ->sortable()
                    ->formatStateUsing(function ($state) {
                        if ($state == 'Atrasado') {
                            return '<span class="text-danger-600 font-bold">⏰ Atrasado</span>';
                        } elseif ($state == 'Porgramado') {
                            return '<span class="text-success-600 font-bold">✅ Programado</span>';
                        } else {
                            return $state; // Para cualquier otro estado
                        }
                    })
                    ->html(),
                Tables\Columns\TextColumn::make('dias_retraso')->label('Dias atraso')->sortable()->searchable(),
                                
                Tables\Columns\TextColumn::make('antecedentes')
                ->label('Alerta AntObs')
                ->sortable()
                ->formatStateUsing(function ($state) {
                    return $state == 1 
                        ? '<span class="text-danger-600">⚠️ Sí</span>' 
                        : '<span class="text-success">✓ No</span>';
                })
                ->html(),
                Tables\Columns\TextColumn::make('control')
                ->label('Alerta Control')
                ->sortable()
                ->formatStateUsing(function ($state) {
                    return $state == 1 
                        ? '<span class="text-danger-600">⚠️ Sí</span>' 
                        : '<span class="text-success">✓ No</span>';
                })
                ->html(),
                Tables\Columns\TextColumn::make('bandera_edad')
                ->label('Alerta Edad')
                ->sortable()
                ->formatStateUsing(function ($state) {
                    return $state == 1 
                        ? '<span class="text-danger-600">⚠️ Sí</span>' 
                        : '<span class="text-success">✓ No</span>';
                })
                ->html(),



                Tables\Columns\TextColumn::make('necesita_seguimiento')
                ->label('Necesita seguimiento')
                ->sortable()
                ->formatStateUsing(function ($state) {
                    return $state == 1 
                        ? '<span class="text-success">✓ Si</span>' 
                        : '<span class="text-danger-600">⚠️ No</span>';
                })
                ->html(),
                Tables\Columns\TextColumn::make('seguimiento_completado')
                ->label('Seguimiento completado')
                ->sortable()
                ->formatStateUsing(function ($state) {
                    return $state == 1 
                        ? '<span class="text-success">✓ Si</span>' 
                        : '<span class="text-danger-600">⚠️ No</span>';
                })
                ->html(),
                Tables\Columns\TextColumn::make('fecha_proximo_seguimiento')->label('Próxima fecha de seguimiento')->date()->sortable(),
          
              

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('Ver Control')

    ->label('Editar Control')
    ->url(fn ($record) => ControlResource::getUrl('edit', ['record' => $record->id]))
    ->openUrlInNewTab(false)
    ->visible(fn ($record) => $record->control === 1) // Solo mostrar si tiene control activo
    ->color('primary')
    ->icon('heroicon-o-pencil')

                ])
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('estado_seguimiento')
                    ->label('Estado de Seguimiento')
                    ->options([
                        'Atrasado' => 'Atrasado',
                        'Programado' => 'Programado',
                    ])
                    ->default(null) // Ninguno seleccionado por defecto
                    ->placeholder('Todos los registros'),
            ]);

    }
    
}
