<?php

namespace App\Filament\Resources\AntobsResource\Pages;

use App\Filament\Resources\AntobsResource;
use App\Filament\Resources\ControlResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAntobs extends CreateRecord
{
    protected static string $resource = AntobsResource::class;

    protected function getRedirectUrl(): string
    {
        // Después de crear paciente, redirigir a crear control prenatal
        return ControlResource::getUrl('create', [
            'antecedente_id' => $this->record->id
        ]);
    }

}
