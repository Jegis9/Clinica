<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class UltimoTrim extends BaseWidget
{
    protected static ?string $heading = 'Pacientes en el ultimo trimestre';
    protected static ?int $sort = 4;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
            \App\Models\Ultimotrim::query()
            )
            ->columns([
                Tables\Columns\TextColumn::make('nombre')->label('Nombre'),
                Tables\Columns\TextColumn::make('apellido')->label('Apellido'),
                Tables\Columns\TextColumn::make('telefono_emergencia')->label('Teléfono'),
                Tables\Columns\TextColumn::make('no_control')->label('Mes de control'),
     
            ]);
    }
}
