<?php

namespace App\Filament\Resources\PregnancieResource\Pages;

use App\Filament\Resources\PregnancieResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPregnancie extends EditRecord
{
    protected static string $resource = PregnancieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
