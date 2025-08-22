<?php

namespace App\Filament\Resources\PrenatalControlResource\Pages;

use App\Filament\Resources\PrenatalControlResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPrenatalControls extends ListRecords
{
    protected static string $resource = PrenatalControlResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
