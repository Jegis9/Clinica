<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PacienteResource\Pages;
use App\Filament\Resources\PacienteResource\RelationManagers;
use App\Models\Paciente;
use App\Models\Ficha;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
class PacienteResource extends Resource
{
    protected static ?string $model = Paciente::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

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
                Tables\Columns\TextColumn::make('telefono_emergencia')->label('Tel. emergencia'),
 
            ])
            ->filters([
                //
            ])
        ->headerActions([
            Action::make('descargarPDFCompleto')
                ->label('Descargar PDF')
        
                ->color('danger')
                ->action(function () {
                    $pacientes = \App\Models\Paciente::all();
                    
                    // Configurar PDF en horizontal (landscape)
                    $pdf = Pdf::loadView('pdf.pacientes-completo', [
                        'pacientes' => $pacientes,
                        'fecha' => now()->format('d/m/Y H:i')
                    ])->setPaper('a4', 'landscape'); // ← Aquí configuras horizontal
                    
                    return Response::streamDownload(
                        function () use ($pdf) {
                            echo $pdf->stream();
                        },
                        'pacientes-horizontal-' . now()->format('Y-m-d') . '.pdf'
                    );
                })
        ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('Ver antecedestes')
                    ->label('Ver antecedestes')
            
                    ->url(fn (Paciente $record) => 
                        $record->antobs 
                            ? AntobsResource::getUrl('edit', ['record' => $record->antobs->id]) // CORRECCIÓN: usar el ID de antobs, no paciente_id
                            : AntobsResource::getUrl('create', ['paciente_id' => $record->id]) // Opcional: crear nuevo si no existe
                    )
                    ->openUrlInNewTab(false) // Opcional: abrir en la misma pestaña
                    ->visible(fn (Paciente $record) => $record->antobs !== null),
                

                Tables\Actions\Action::make('descargarHistorialCompleto')
                ->label('Historial Completo')
                ->icon('heroicon-o-document-text')
                ->color('info')
                ->action(function ($record) {
                    // Consulta directa a la vista ficha
                    $datos = DB::table('ficha')
                        ->where('paciente_id', $record->id)
                        ->orderBy('fecha', 'DESC')
                        ->get();
                    
                    // Tomar el primer registro para datos únicos
                    $datosUnicos = $datos->first();
                    $historicos = $datos;
                    
                    $pdf = Pdf::loadView('pdf.pacientes-ficha', [
                        'datosPaciente' => $datosUnicos,
                        'historicos' => $historicos,
                        'fecha' => now()->format('d/m/Y H:i')
                    ])->setPaper('a4', 'portrait');
                    
                    return Response::streamDownload(
                        function () use ($pdf) {
                            echo $pdf->stream();
                        },
                        'pacientes-ficha-' . $record->id . '-' . now()->format('Y-m-d') . '.pdf'
                    );
                })

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
        return 1; // Primera posición
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with('antobs'); // Cargar la relación eager loading
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
