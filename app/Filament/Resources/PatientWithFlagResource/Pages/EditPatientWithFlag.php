<?php

namespace App\Filament\Resources\PatientWithFlagResource\Pages;

use App\Filament\Resources\PatientWithFlagResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPatientWithFlag extends EditRecord
{
    protected static string $resource = PatientWithFlagResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
