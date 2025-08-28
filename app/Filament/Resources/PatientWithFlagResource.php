<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientWithFlagResource\Pages;
use App\Filament\Resources\PatientWithFlagResource\RelationManagers;
use App\Models\PatientWithFlag;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PatientWithFlagResource extends Resource
{
    protected static ?string $model = PatientWithFlag::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

            ]);
    }

public static function getEloquentQuery(): Builder
{
    return parent::getEloquentQuery()
        ->where(function ($query) {
            $query->where('has_antobs_flags', true)
                  ->orWhere('has_controls_flags', true)
                  ->orWhere('has_age_flags', true);
        });
}
    public static function table(Table $table): Table
    {
        return $table
            ->columns([

        Tables\Columns\TextColumn::make('nombre')
            ->searchable(),
        Tables\Columns\TextColumn::make('apellido')
            ->searchable(),
        Tables\Columns\TextColumn::make('telefono_emergencia')
            ->searchable(),
        Tables\Columns\IconColumn::make('has_antobs_flags')
            ->boolean()
            ->label('Antecedentes'),
        Tables\Columns\IconColumn::make('has_controls_flags')
            ->boolean()
            ->label('Controles'),
        Tables\Columns\IconColumn::make('has_age_flags')
            ->boolean()
            ->label('Riesgo de edad'),
        Tables\Columns\TextColumn::make('edad')
            ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
               
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {
        return false;
    }

    public static function canDelete($record): bool
    {
        return false;
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPatientWithFlags::route('/'),
            'create' => Pages\CreatePatientWithFlag::route('/create'),
            'edit' => Pages\EditPatientWithFlag::route('/{record}/edit'),
        ];
    }
}
