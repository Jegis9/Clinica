<?php

namespace App\Filament\Resources\AntobsResource\Pages;

use App\Filament\Resources\AntobsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAntobs extends EditRecord
{
    protected static string $resource = AntobsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
