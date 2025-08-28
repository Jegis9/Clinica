<?php

namespace App\Filament\Pages;

use App\Models\ObstetricRisk;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class RiskReports extends Page implements Tables\Contracts\HasTable
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.risk-reports';
    use Tables\Concerns\InteractsWithTable;

    protected static ?string $navigationLabel = 'Obstetric Risk Reports';
    protected static ?string $navigationGroup = 'Reports';

    public function table(Table $table): Table
    {
        return $table
            ->query(
 
            )
            ->columns([


                Tables\Columns\IconColumn::make('previous_cesarean')
                    ->label('Cesarean')
                    ->boolean(),

                Tables\Columns\IconColumn::make('age_under20')
                    ->label('Age <20')
                    ->boolean(),

                Tables\Columns\IconColumn::make('age_35plus')
                    ->label('Age ≥35')
                    ->boolean(),

                Tables\Columns\IconColumn::make('anemia')
                    ->label('Anemia')
                    ->boolean(),

                Tables\Columns\IconColumn::make('hypertension_current')
                    ->label('Hypertension')
                    ->boolean(),
            ])
            ->filters([
                // Puedes agregar filtros aquí si necesitas
            ])
            ->actions([
                // Puedes agregar acciones aquí si necesitas
            ])
            ->bulkActions([
                // Puedes agregar acciones masivas aquí si necesitas
            ]);
    }
}