<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DoctorResource\Pages;
use App\Filament\Resources\DoctorResource\RelationManagers;
use App\Models\Doctor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\IconColumn;

class DoctorResource extends Resource
{
    protected static ?string $model = Doctor::class;
  
    protected static ?string $pluralModelLabel = 'Doctores';  // Plural


    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make('dpi')
                    ->label('DPI')
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->maxLength(255)
                    ->required(),
                Forms\Components\TextInput::make('lastname')
                    ->label('Lastname')
                    ->maxLength(255)
                    ->required(),
                Forms\Components\TextInput::make('phone')
                    ->label('Phone')
                    ->maxLength(255)
                    ->nullable(),
                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255)
                    ->required(),

                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Active',
                        'desactive' => 'Desactive',
                    ])
                    ->default('active')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
           
                Tables\Columns\TextColumn::make('dpi')->label('DPI')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('name')->label('Name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('lastname')->label('Lastname')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('phone')->label('Phone')->searchable(),
                Tables\Columns\TextColumn::make('email')->label('Email')->searchable(),
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
            'index' => Pages\ListDoctors::route('/'),
            'create' => Pages\CreateDoctor::route('/create'),
            'edit' => Pages\EditDoctor::route('/{record}/edit'),
        ];
    }
}
