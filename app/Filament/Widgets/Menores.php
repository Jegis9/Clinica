<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class Menores extends BaseWidget
{

    protected static ?string $heading = 'Pacientes menores de 14 años';
    protected static ?int $sort = 4;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
            \App\Models\menores::query()
            )
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID')->sortable(),
                Tables\Columns\TextColumn::make('nombre')->label('Nombre')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('apellido')->label('Apellido')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('birth_date')->label('Fecha de Nacimiento')->sortable()->date(),
                Tables\Columns\TextColumn::make('edad')->label('Edad')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('escolaridad')->label('escolaridad')->sortable()->searchable(),

                Tables\Columns\TextColumn::make('ocupacion')->label('Ciudad')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('telefono_emergencia')->label('telefono')->sortable()->searchable(),


            ]);
    }
}
