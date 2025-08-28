<?php

namespace App\Filament\Resources\PacienteResource\Pages;

use App\Filament\Resources\PacienteResource;
use App\Filament\Resources\AntobsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePaciente extends CreateRecord
{
    protected static string $resource = PacienteResource::class;

    protected function getRedirectUrl(): string
    {
        // Después de crear paciente, redirigir a crear control prenatal
        return AntobsResource::getUrl('create', [
            'patient_id' => $this->record->id
        ]);
    }


}
