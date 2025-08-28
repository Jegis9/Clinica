<?php

namespace App\Filament\Resources\PatientWithFlagResource\Pages;

use App\Filament\Resources\PatientWithFlagResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPatientWithFlags extends ListRecords
{
    protected static string $resource = PatientWithFlagResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
