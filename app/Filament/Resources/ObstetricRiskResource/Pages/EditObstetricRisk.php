<?php

namespace App\Filament\Resources\ObstetricRiskResource\Pages;

use App\Filament\Resources\ObstetricRiskResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditObstetricRisk extends EditRecord
{
    protected static string $resource = ObstetricRiskResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
