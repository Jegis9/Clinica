<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AntobsResource\Pages;
use App\Filament\Resources\AntobsResource\RelationManagers;
use App\Models\Antobs;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AntobsResource extends Resource
{
    protected static ?string $model = Antobs::class;
   
    protected static ?string $navigationLabel = 'Antecedentes ';
    protected static ?string $pluralModelLabel = 'Antecedentes Obstetricos';


    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            Forms\Components\Hidden::make('paciente_id')
                ->default(fn () => request()->get('patient_id'))
                ->required(),
            Forms\Components\Toggle::make('muerte')
                ->label('Muerte fetal/neonatal previa'),
            Forms\Components\Toggle::make('abortos')
                ->label('Abortos espontáneos'),
            Forms\Components\Toggle::make('gestas')
                ->label('≥3 gestas'),
            Forms\Components\Toggle::make('peso_bajo')
                ->label('Bajo peso previo'),
            Forms\Components\Toggle::make('pesoa')
                ->label('Peso alto previo'),
            Forms\Components\Toggle::make('hipertencion')
                ->label('Hipertensión'),
            Forms\Components\Toggle::make('cirujias')
                ->label('Cirugías previas'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('paciente.id')->label('ID')->sortable(),
            Tables\Columns\TextColumn::make('paciente.nombre')->label('Nombre de paciente')->sortable(),
            Tables\Columns\IconColumn::make('cirujias')->label('Cesarias previas')->boolean(),

        
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
    public static function getNavigationSort(): int
    {
        return 3; // Primera posición
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAntobs::route('/'),
            'create' => Pages\CreateAntobs::route('/create'),
            'edit' => Pages\EditAntobs::route('/{record}/edit'),
        ];
    }
}
