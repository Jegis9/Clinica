<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PacienteResource\Pages;
use App\Filament\Resources\PacienteResource\RelationManagers;
use App\Models\Paciente;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PacienteResource extends Resource
{
    protected static ?string $model = Paciente::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('registro_no')
                    ->label('Registro No')
                    ->unique(ignoreRecord: true)
                    ->maxLength(255)
                    ->nullable(),
                Forms\Components\TextInput::make('nombre')
                    ->label('Nombre')
                    ->maxLength(255)
                    ->nullable(),
                Forms\Components\TextInput::make('apellido')
                    ->label('Apellido')
                    ->maxLength(255)
                    ->nullable(),
                Forms\Components\DatePicker::make('birth_date')
                    ->label('Fecha de nacimiento')
                    ->nullable(),
                Forms\Components\TextInput::make('pueblo')
                    ->label('Pueblo')
                    ->maxLength(255)
                    ->nullable(),
                Forms\Components\TextInput::make('escolaridad')
                    ->label('Escolaridad')
                    ->maxLength(255)
                    ->nullable(),
                Forms\Components\TextInput::make('ocupacion')
                    ->label('Ocupación')
                    ->maxLength(255)
                    ->nullable(),
                Forms\Components\TextInput::make('nombre_esposo')
                    ->label('Nombre del esposo')
                    ->maxLength(255)
                    ->nullable(),
                Forms\Components\TextInput::make('pueblo_esposo')
                    ->label('Pueblo del esposo')
                    ->maxLength(255)
                    ->nullable(),
                Forms\Components\TextInput::make('escolaridad_esposo')
                    ->label('Escolaridad del esposo')
                    ->maxLength(255)
                    ->nullable(),
                Forms\Components\TextInput::make('ocupacion_esposo')
                    ->label('Ocupación del esposo')
                    ->maxLength(255)
                    ->nullable(),
                Forms\Components\Select::make('estado_civil')
                    ->label('Estado civil')
                    ->options([
                        'soltera' => 'Soltera',
                        'casada' => 'Casada',
                        'union_libre' => 'Unión libre',
                        'divorciada' => 'Divorciada',
                        'viuda' => 'Viuda',
                    ])
                    ->nullable(),
                Forms\Components\TextInput::make('distancia_servicio_salud_km')
                    ->label('Distancia a servicio de salud (km)')
                    ->numeric()
                    ->nullable(),
                Forms\Components\TextInput::make('tiempo_servicio_salud_hrs')
                    ->label('Tiempo a servicio de salud (hrs)')
                    ->numeric()
                    ->nullable(),
                Forms\Components\TextInput::make('nombre_comunidad')
                    ->label('Nombre de la comunidad')
                    ->maxLength(255)
                    ->nullable(),
                Forms\Components\TextInput::make('telefono_emergencia')
                    ->label('Teléfono de emergencia')
                    ->maxLength(255)
                    ->nullable(),
                Forms\Components\DatePicker::make('fecha_ultima_regla')
                    ->label('Fecha última regla')
                    ->nullable(),
                Forms\Components\DatePicker::make('fpp')
                    ->label('FPP')
                    ->nullable(),
                Forms\Components\TextInput::make('no_embarazos')
                    ->label('No. embarazos')
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('no_partos')
                    ->label('No. partos')
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('no_cesareas')
                    ->label('No. cesáreas')
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('no_abortos')
                    ->label('No. abortos')
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('no_hijos_vivos')
                    ->label('No. hijos vivos')
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('no_hijos_muertos')
                    ->label('No. hijos muertos')
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('registro_no')->label('Registro')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('nombre')->label('Nombre')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('apellido')->label('Apellido')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('birth_date')->label('Nacimiento')->date()->sortable(),
                Tables\Columns\TextColumn::make('pueblo')->label('Pueblo')->searchable(),
                Tables\Columns\TextColumn::make('escolaridad')->label('Escolaridad')->searchable(),
                Tables\Columns\TextColumn::make('ocupacion')->label('Ocupación')->searchable(),
                Tables\Columns\TextColumn::make('nombre_esposo')->label('Nombre esposo')->searchable(),
                Tables\Columns\TextColumn::make('pueblo_esposo')->label('Pueblo esposo')->searchable(),
                Tables\Columns\TextColumn::make('escolaridad_esposo')->label('Escolaridad esposo')->searchable(),
                Tables\Columns\TextColumn::make('ocupacion_esposo')->label('Ocupación esposo')->searchable(),
                Tables\Columns\TextColumn::make('estado_civil')->label('Estado civil')->sortable(),
                Tables\Columns\TextColumn::make('distancia_servicio_salud_km')->label('Distancia salud (km)'),
                Tables\Columns\TextColumn::make('tiempo_servicio_salud_hrs')->label('Tiempo salud (hrs)'),
                Tables\Columns\TextColumn::make('nombre_comunidad')->label('Comunidad')->searchable(),
                Tables\Columns\TextColumn::make('telefono_emergencia')->label('Tel. emergencia'),
                Tables\Columns\TextColumn::make('fecha_ultima_regla')->label('Última regla')->date(),
                Tables\Columns\TextColumn::make('fpp')->label('FPP')->date(),
                Tables\Columns\TextColumn::make('no_embarazos')->label('Embarazos'),
                Tables\Columns\TextColumn::make('no_partos')->label('Partos'),
                Tables\Columns\TextColumn::make('no_cesareas')->label('Cesáreas'),
                Tables\Columns\TextColumn::make('no_abortos')->label('Abortos'),
                Tables\Columns\TextColumn::make('no_hijos_vivos')->label('Hijos vivos'),
                Tables\Columns\TextColumn::make('no_hijos_muertos')->label('Hijos muertos'),
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
            'index' => Pages\ListPacientes::route('/'),
            'create' => Pages\CreatePaciente::route('/create'),
            'edit' => Pages\EditPaciente::route('/{record}/edit'),
        ];
    }
}
