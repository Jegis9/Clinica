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
use Filament\Forms\Components\Select;

class ControlResource extends Resource 
{
    protected static ?string $model = Control::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Campo hidden para antecedente_id
                Forms\Components\Hidden::make('antecedente_id')
                    ->default(fn () => request()->get('antecedente_id'))
                    ->required(),
                    
                Select::make('no_control')
                    ->label('No. de control')
                    ->options([
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                    ]),
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
                    ->nullable(),
                Forms\Components\Toggle::make('seguimiento_completado')
                    ->label('Seguimiento Completado')
                    ->default(false),
                Forms\Components\DatePicker::make('fecha_ultimo_seguimiento')
                    ->label('Fecha Ultimo Seguimiento')
                    ->nullable(),
                Forms\Components\DatePicker::make('fecha_proximo_seguimiento')
                    ->label('Fecha Proximo Seguimiento')
                    ->nullable(),
                Forms\Components\Textarea::make('observaciones_seguimiento')
                    ->label('Observaciones Seguimiento')
                    ->rows(3)
                    ->maxLength(65535)
                    ->nullable(),
                Forms\Components\Toggle::make('necesita_seguimiento')
                    ->label('Necesita Seguimiento')
                    ->default(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('antobs.id')
                    ->label('Antecedente ID')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_control')
                    ->label('No Control'),
                Tables\Columns\TextColumn::make('fecha')
                    ->label('Fecha')
                    ->date()
                    ->sortable(),
                Tables\Columns\IconColumn::make('multiple')
                    ->label('Multiple')
                    ->boolean()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListControls::route('/'),
            'create' => Pages\CreateControl::route('/create'),
            'edit' => Pages\EditControl::route('/{record}/edit'),
        ];
    }
}