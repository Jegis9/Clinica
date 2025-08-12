<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SpecialtiesResource\Pages;
use App\Filament\Resources\SpecialtiesResource\RelationManagers;
use App\Models\Specialties;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\IconColumn;

class SpecialtiesResource extends Resource
{
    protected static ?string $model = Specialties::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            Forms\Components\TextInput::make('name')
                ->label('Name')
                ->required()
                ->maxLength(255),
            Forms\Components\Textarea::make('description')
                ->label('Description')
                ->nullable(),
            Forms\Components\Select::make('status')
                ->label('Status')
                ->options([
                    'active' => 'Active',
                    'inactive' => 'Inactive',
                    ])
                ->default('active')
                ->required(),
            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('name')->label('Name')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('description')->label('Description')->limit(30),
            IconColumn::make('status')
                ->label('Estado')
                ->icon(fn (string $state): string => match ($state) {
                    'active' => 'heroicon-o-check-circle', // Icono para "activo"
                    'inactive' => 'heroicon-o-x-circle',   // Icono para "inactivo"
                    default => 'heroicon-o-question-mark-circle',
                })
                ->color(fn (string $state): string => match ($state) {
                    'active' => 'success', // Color verde
                    'inactive' => 'danger', // Color rojo
                    default => 'gray',
                })
                ->sortable(),
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
            'index' => Pages\ListSpecialties::route('/'),
            'create' => Pages\CreateSpecialties::route('/create'),
            'edit' => Pages\EditSpecialties::route('/{record}/edit'),
        ];
    }
}
