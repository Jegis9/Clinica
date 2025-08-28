<?php

namespace App\Filament\Resources\AntobsResource\Pages;

use App\Filament\Resources\AntobsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAntobs extends ListRecords
{
    protected static string $resource = AntobsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
