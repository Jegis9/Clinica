<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DateResource\Pages;
use App\Filament\Resources\DateResource\RelationManagers;
use App\Models\Date;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\IconColumn;

class DateResource extends Resource
{
    protected static ?string $model = Date::class;

    protected static ?string $modelLabel = 'Cita medica';  // Singular
    protected static ?string $pluralModelLabel = 'Citas medicas';  // Plural
    protected static ?string $navigationLabel = 'Cita medica';  // Navbar

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('patient_id')
                    ->label('Paciente')
                    ->relationship('patient', 'first_name')
                    ->required(),
                Forms\Components\Select::make('doctor_id')
                    ->label('Médico')
                    ->relationship('doctor', 'name')
                    ->required(),
                Forms\Components\DateTimePicker::make('date')
                    ->label('Fecha de la cita')
                    ->required(),
                Forms\Components\Textarea::make('reason')
                    ->label('Motivo')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'Programada'=> 'Programada',
                        'Confirmada'=> 'Confirmada',
                        'Completada'=> 'Completada',
                        'Cancelada'=> 'Cancelada',
                        'No asistió'=> 'No asistió',
                    ]),
                Forms\Components\Textarea::make('notes')
                    ->label('Notas')
                    ->nullable(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID')->sortable(),
                Tables\Columns\TextColumn::make('patient.first_name')->label('Paciente')->searchable(),
                Tables\Columns\TextColumn::make('doctor.name')->label('Médico')->searchable(),
                Tables\Columns\TextColumn::make('date')->label('Fecha de la cita')->dateTime()->sortable(),
                Tables\Columns\TextColumn::make('reason')->label('Motivo')->limit(30),
                IconColumn::make('status')
                    ->label('Estado')
                    ->icon(fn (string $state): string => match ($state) {
                        'Programada' => 'heroicon-o-clock',
                        'Confirmada' => 'heroicon-o-check-circle',
                        'Completada' => 'heroicon-o-check-badge',
                        'Cancelada' => 'heroicon-o-x-circle',
                        'No asistió' => 'heroicon-o-user-minus',
                        default => 'heroicon-o-question-mark-circle',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'Programada' => 'info',
                        'Confirmada' => 'success',
                        'Completada' => 'primary',
                        'Cancelada' => 'danger',
                        'No asistió' => 'warning',
                        default => 'gray',
                    })
        
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
            'index' => Pages\ListDates::route('/'),
            'create' => Pages\CreateDate::route('/create'),
            'edit' => Pages\EditDate::route('/{record}/edit'),
        ];
    }
}
