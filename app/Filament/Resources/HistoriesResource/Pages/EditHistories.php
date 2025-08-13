<?php

namespace App\Filament\Resources\HistoriesResource\Pages;

use App\Filament\Resources\HistoriesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHistories extends EditRecord
{
    protected static string $resource = HistoriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
