<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ControlResource\Pages;
use App\Filament\Resources\ControlResource\RelationManagers;
use App\Models\Control;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ControlResource extends Resource
{
    protected static ?string $model = Control::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Hidden::make('antecedente_id')
                    ->default(fn () => request()->get('antecedente_id'))
                    ->required(),
                Forms\Components\TextInput::make('no_control')
                    ->numeric()
                    ->required()
                    ->default(0),
                Forms\Components\DatePicker::make('fecha')
                    ->label('Fecha')
                    ->nullable(),
                Forms\Components\Toggle::make('multiple')
                    ->label('Multiple')
                    ->default(false),
                Forms\Components\Toggle::make('rh')
                    ->label('RH')
                    ->default(false),
                Forms\Components\Toggle::make('hemorragia')
                    ->label('Hemorragia')
                    ->default(false),
                Forms\Components\Toggle::make('vih')
                    ->label('VIH')
                    ->default(false),
                Forms\Components\Toggle::make('precion')
                    ->label('Presion')
                    ->default(false),
                Forms\Components\Toggle::make('anemia')
                    ->label('Anemia')
                    ->default(false),
                Forms\Components\Toggle::make('desnutricion')
                    ->label('Desnutricion')
                    ->default(false),
                Forms\Components\Toggle::make('dolor')
                    ->label('Dolor')
                    ->default(false),
                Forms\Components\Toggle::make('sintomologia')
                    ->label('Sintomologia')
                    ->default(false),
                Forms\Components\Toggle::make('ictericia')
                    ->label('Ictericia')
                    ->default(false),
                Forms\Components\Toggle::make('diabetes')
                    ->label('Diabetes')
                    ->default(false),
                Forms\Components\Toggle::make('renal')
                    ->label('Renal')
                    ->default(false),
                Forms\Components\Toggle::make('corazon')
                    ->label('Corazon')
                    ->default(false),
                Forms\Components\Toggle::make('hipertencion')
                    ->label('Hipertencion')
                    ->default(false),
                Forms\Components\Toggle::make('drogras')
                    ->label('Drogas')
                    ->default(false),
                Forms\Components\Toggle::make('enfermedad')
                    ->label('Enfermedad')
                    ->default(false),
                Forms\Components\Textarea::make('otros')
                    ->label('Otros')
                    ->rows(3)
                    ->maxLength(65535)
                    ->nullable()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID')->sortable()->searchable(),

                Tables\Columns\IconColumn::make('no_control')
                    ->label('No Control')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha')
                    ->label('Fecha')
                    ->date()
                    ->sortable(),
                Tables\Columns\IconColumn::make('multiple')
                    ->label('Multiple')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\IconColumn::make('rh')
                    ->label('RH')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\IconColumn::make('hemorragia')
                    ->label('Hemorragia')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\IconColumn::make('vih')
                    ->label('VIH')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\IconColumn::make('precion')
                    ->label('Presion')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\IconColumn::make('anemia')
                    ->label('Anemia')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\IconColumn::make('desnutricion')
                    ->label('Desnutricion')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\IconColumn::make('dolor')
                    ->label('Dolor')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\IconColumn::make('sintomologia')
                    ->label('Sintomologia')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\IconColumn::make('ictericia')
                    ->label('Ictericia')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\IconColumn::make('diabetes')
                    ->label('Diabetes')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\IconColumn::make('renal')
                    ->label('Renal')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\IconColumn::make('corazon')
                    ->label('Corazon')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\IconColumn::make('hipertencion')
                    ->label('Hipertencion')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\IconColumn::make('drogras')
                    ->label('Drogas')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\IconColumn::make('enfermedad')
                    ->label('Enfermedad')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('otros')
                    ->label('Otros')
                    ->limit(50)
                    ->sortable()->searchable(),
      
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
            'index' => Pages\ListControls::route('/'),
            'create' => Pages\CreateControl::route('/create'),
            'edit' => Pages\EditControl::route('/{record}/edit'),
        ];
    }
}
