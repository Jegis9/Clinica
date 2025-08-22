<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ObstetricRiskResource\Pages;
use App\Filament\Resources\ObstetricRiskResource\RelationManagers;
use App\Models\ObstetricRisk;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ObstetricRiskResource extends Resource
{
    protected static ?string $model = ObstetricRisk::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('control_id')
                    ->label('Control Prenatal')
                    ->relationship('prenatalControl', 'id')
                    ->required(),
                Forms\Components\Toggle::make('previous_fetal_death')->label('Muerte fetal/neonatal previa'),
                Forms\Components\Toggle::make('recurrent_abortions')->label('≥3 abortos espontáneos'),
                Forms\Components\Toggle::make('multigravida')->label('≥3 embarazos'),
                Forms\Components\Toggle::make('previous_low_weight')->label('Bajo peso previo (<2500g)'),
                Forms\Components\Toggle::make('previous_macrosomia')->label('Macrosomía previa (>4500g)'),
                Forms\Components\Toggle::make('hypertension_history')->label('Antecedente de hipertensión/preeclampsia'),
                Forms\Components\Toggle::make('previous_cesarean')->label('Cesárea previa'),
                Forms\Components\Toggle::make('previous_surgeries')->label('Cirugías reproductivas previas'),
                Forms\Components\Toggle::make('multiple_pregnancy')->label('Embarazo múltiple actual'),
                Forms\Components\Toggle::make('age_under20')->label('Edad materna <20'),
                Forms\Components\Toggle::make('age_35plus')->label('Edad materna ≥35'),
                Forms\Components\Toggle::make('anemia')->label('Anemia clínica o laboratorial'),
                Forms\Components\Toggle::make('malnutrition')->label('Desnutrición u obesidad'),
                Forms\Components\Toggle::make('abdominal_pain')->label('Dolor abdominal'),
                Forms\Components\Toggle::make('urinary_symptoms')->label('Síntomas urinarios'),
                Forms\Components\Toggle::make('jaundice')->label('Ictericia'),
                Forms\Components\Toggle::make('hiv_syphilis_positive')->label('VIH o sífilis positivo'),
                Forms\Components\Toggle::make('hypertension_current')->label('Hipertensión actual'),
                Forms\Components\Textarea::make('other_conditions')->label('Otras condiciones')->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('risk_id')->label('ID')->sortable(),
                Tables\Columns\TextColumn::make('prenatalControl.id')->label('Control')->sortable(),
                Tables\Columns\IconColumn::make('previous_fetal_death')->label('Muerte fetal/neonatal previa')->boolean(),
                Tables\Columns\IconColumn::make('recurrent_abortions')->label('≥3 abortos espontáneos')->boolean(),
                Tables\Columns\IconColumn::make('multigravida')->label('≥3 embarazos')->boolean(),
                Tables\Columns\IconColumn::make('previous_low_weight')->label('Bajo peso previo')->boolean(),
                Tables\Columns\IconColumn::make('previous_macrosomia')->label('Macrosomía previa')->boolean(),
                Tables\Columns\IconColumn::make('hypertension_history')->label('Antecedente HTA/preeclampsia')->boolean(),
                Tables\Columns\IconColumn::make('previous_cesarean')->label('Cesárea previa')->boolean(),
                Tables\Columns\IconColumn::make('previous_surgeries')->label('Cirugías previas')->boolean(),
                Tables\Columns\IconColumn::make('multiple_pregnancy')->label('Embarazo múltiple')->boolean(),
                Tables\Columns\IconColumn::make('age_under20')->label('Edad <20')->boolean(),
                Tables\Columns\IconColumn::make('age_35plus')->label('Edad ≥35')->boolean(),
                Tables\Columns\IconColumn::make('anemia')->label('Anemia')->boolean(),
                Tables\Columns\IconColumn::make('malnutrition')->label('Desnutrición/obesidad')->boolean(),
                Tables\Columns\IconColumn::make('abdominal_pain')->label('Dolor abdominal')->boolean(),
                Tables\Columns\IconColumn::make('urinary_symptoms')->label('Síntomas urinarios')->boolean(),
                Tables\Columns\IconColumn::make('jaundice')->label('Ictericia')->boolean(),
                Tables\Columns\IconColumn::make('hiv_syphilis_positive')->label('VIH/sífilis +')->boolean(),
                Tables\Columns\IconColumn::make('hypertension_current')->label('HTA actual')->boolean(),
                Tables\Columns\TextColumn::make('other_conditions')->label('Otras condiciones')->limit(30),
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
            'index' => Pages\ListObstetricRisks::route('/'),
            'create' => Pages\CreateObstetricRisk::route('/create'),
            'edit' => Pages\EditObstetricRisk::route('/{record}/edit'),
        ];
    }
}
