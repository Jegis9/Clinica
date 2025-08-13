<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HistoriesResource\Pages;
use App\Filament\Resources\HistoriesResource\RelationManagers;
use App\Models\Histories;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HistoriesResource extends Resource
{
    protected static ?string $model = Histories::class;
    protected static ?string $modelLabel = 'Historia clinica';  // Singular
    protected static ?string $pluralModelLabel = 'Historias clinicas';  // Plural
    protected static ?string $navigationLabel = 'Historia clinica';  // Navbar

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('patient_id')
                    ->label('Paciente')
                    ->relationship('patient', 'first_name') // Asegúrate que 'patient' sea el nombre de la relación
                    ->required(),

                Forms\Components\DateTimePicker::make('date_consulting') // Cambiado a coincidir con migración
                    ->label('Fecha de Consulta')
                    ->required(),

                Forms\Components\Select::make('doctor_id')
                    ->label('Médico')
                    ->relationship('doctor', 'name') // Asegúrate que 'doctor' sea el nombre de la relación
                    ->required(),
                                
                Forms\Components\Textarea::make('diagnostic') // Cambiado a coincidir con migración
                    ->label('Diagnóstico')
                    ->required(),

                Forms\Components\Textarea::make('treatment') // Cambiado a coincidir con migración
                    ->label('Tratamiento')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID')->sortable(),
                Tables\Columns\TextColumn::make('patient.first_name')->label('Paciente')->searchable(),
                Tables\Columns\TextColumn::make('date_consulting')->label('Fecha de Consulta')->dateTime()->sortable(),
                Tables\Columns\TextColumn::make('doctor.name')->label('Médico')->searchable(),
                Tables\Columns\TextColumn::make('diagnostic')->label('Diagnóstico')->limit(30),
                

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListHistories::route('/'),
            'create' => Pages\CreateHistories::route('/create'),
            'edit' => Pages\EditHistories::route('/{record}/edit'),
        ];
    }
}
