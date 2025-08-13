<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientResource\Pages;
use App\Filament\Resources\PatientResource\RelationManagers;
use App\Models\Patient;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\IconColumn;

class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;

    protected static ?string $navigationIcon = 'heroicon-o-queue-list';
    protected static ?string $modelLabel = 'Paciente';  // Singular
    protected static ?string $pluralModelLabel = 'Pacientes';  // Plural
    protected static ?string $navigationLabel = 'Pacientes';  // Navbar
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('dpi')
                    ->label('DPI')
                    ->unique(ignoreRecord: true)
                    ->maxLength(255)
                    ->nullable(),
                Forms\Components\TextInput::make('first_name')
                    ->label('First Name')
                    ->maxLength(255)
                    ->nullable(),
                Forms\Components\TextInput::make('last_name')
                    ->label('Last Name')
                    ->maxLength(255)
                    ->nullable(),
                Forms\Components\DatePicker::make('birth_date')
                    ->label('Birth Date')
                    ->nullable(),
                Forms\Components\Select::make('gender')
                    ->label('Gender')
                    ->options([
                        'F' => 'Female',
                        'M' => 'Male',
                    ])
                    ->nullable(),
                Forms\Components\TextInput::make('direction')
                    ->label('Direction')
                    ->maxLength(255)
                    ->nullable(),
                Forms\Components\TextInput::make('phone')
                    ->label('Phone')
                    ->maxLength(255)
                    ->nullable(),
                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255)
                    ->nullable(),
                Forms\Components\TextInput::make('type_of_blood')
                    ->label('Type of Blood')
                    ->maxLength(255)
                    ->nullable(),
                Forms\Components\Textarea::make('allergy')
                    ->label('Allergy')
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
         
                Tables\Columns\TextColumn::make('first_name')->label('First Name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('last_name')->label('Last Name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('gender')->label('Gender')->sortable(),
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
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatient::route('/create'),
            'edit' => Pages\EditPatient::route('/{record}/edit'),
        ];
    }
}
