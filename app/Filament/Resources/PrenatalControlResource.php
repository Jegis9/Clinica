<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PrenatalControlResource\Pages;
use App\Filament\Resources\PrenatalControlResource\RelationManagers;
use App\Models\PrenatalControl;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PrenatalControlResource extends Resource
{
    protected static ?string $model = PrenatalControl::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('pregnancy_id')
                    ->label('Embarazo')
                    ->relationship('pregnancie', 'id')
                    ->required(),
                Forms\Components\TextInput::make('control_number')
                    ->label('Número de control')
                    ->numeric()
                    ->required(),
                Forms\Components\DatePicker::make('control_date')
                    ->label('Fecha del control')
                    ->required(),
                Forms\Components\TextInput::make('gestational_weeks')
                    ->label('Semanas gestacionales')
                    ->numeric()
                    ->required(),
                Forms\Components\Toggle::make('is_risk')
                    ->label('¿Riesgo?')
                    ->required(),
                Forms\Components\Textarea::make('notes')
                    ->label('Observaciones')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('control_number')->label('N° Control')->sortable(),
                Tables\Columns\TextColumn::make('control_date')->label('Fecha')->date()->sortable(),
                Tables\Columns\TextColumn::make('gestational_weeks')->label('Semanas'),
                Tables\Columns\IconColumn::make('is_risk')->label('Riesgo')->boolean(),
                Tables\Columns\TextColumn::make('notes')->label('Observaciones')->limit(30),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListPrenatalControls::route('/'),
            'create' => Pages\CreatePrenatalControl::route('/create'),
            'edit' => Pages\EditPrenatalControl::route('/{record}/edit'),
        ];
    }
}
