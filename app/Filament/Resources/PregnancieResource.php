<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PregnancieResource\Pages;
use App\Filament\Resources\PregnancieResource\RelationManagers;
use App\Models\Pregnancie;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PregnancieResource extends Resource
{
    protected static ?string $model = Pregnancie::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('patient_id')
                    ->label('Paciente')
                    ->relationship('patient', 'first_name')
                    ->required(),
                Forms\Components\DatePicker::make('start_date')
                    ->label('Fecha de inicio')
                    ->required(),
                Forms\Components\TextInput::make('gestational_weeks')
                    ->label('Semanas gestacionales')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('pregnancy_count')
                    ->label('Número de embarazos')
                    ->numeric()
                    ->required(),
                Forms\Components\Toggle::make('previous_cesarean')
                    ->label('Cesárea previa')
                    ->required(),
                Forms\Components\TextInput::make('previous_births')
                    ->label('Partos previos')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('previous_abortions')
                    ->label('Abortos previos')
                    ->numeric()
                    ->required(),
                Forms\Components\Toggle::make('short_interpregnancy')
                    ->label('Intervalo intergenésico corto')
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
          
                Tables\Columns\TextColumn::make('patient.first_name')->label('Paciente')->searchable(),
                Tables\Columns\TextColumn::make('start_date')->label('Inicio')->date()->sortable(),
                Tables\Columns\TextColumn::make('gestational_weeks')->label('Semanas'),
                Tables\Columns\TextColumn::make('pregnancy_count')->label('N° Embarazos'),
                Tables\Columns\IconColumn::make('previous_cesarean')->label('Cesárea previa')->boolean(),
                Tables\Columns\TextColumn::make('previous_births')->label('Partos previos'),
                Tables\Columns\TextColumn::make('previous_abortions')->label('Abortos previos'),
                Tables\Columns\IconColumn::make('short_interpregnancy')->label('Intergenésico corto')->boolean(),
   
            ])
            ->filters([
      
                Tables\Filters\Filter::make('under20')
                    ->label('Edad menor de 20 (Riesgo)')
                    ->query(function ($query) {
                        return $query->whereHas('patient', function ($q) {
                            $q->whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) < 20');
                        });
                    }),

                        


                Tables\Filters\Filter::make('age35plus')
                    ->label('Edad mayor o igual a 35 (Riesgo)')
                    ->query(function ($query) {
                        return $query->whereHas('patient', function ($q) {
                            $q->whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) >= 35');
                        });
                    }),



                // Req. 5: Short interpregnancy
                Tables\Filters\TernaryFilter::make('short_interpregnancy')
                    ->label('Periodo intergenésico corto')
                    ->boolean(),

                // Req. 6: Cesarean
                Tables\Filters\TernaryFilter::make('previous_cesarean')
                    ->label('Cesariana previa')
                    ->boolean(),

                // Req. 9: ≥36 weeks
                Tables\Filters\Filter::make('gest36')
                    ->label('Gestación ≥ 36 semanas')
                    ->query(fn ($query) => $query->where('gestational_weeks', '>=', 36)),
        
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
            'index' => Pages\ListPregnancies::route('/'),
            'create' => Pages\CreatePregnancie::route('/create'),
            'edit' => Pages\EditPregnancie::route('/{record}/edit'),
        ];
    }
}
