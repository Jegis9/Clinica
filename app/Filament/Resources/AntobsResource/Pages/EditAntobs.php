<?php

namespace App\Filament\Resources\AntobsResource\Pages;

use App\Filament\Resources\AntobsResource;
use App\Filament\Resources\ControlResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAntobs extends EditRecord
{
    protected static string $resource = AntobsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
       Actions\Action::make('llenar_control')
            ->label('Llenar Control')
            ->icon('heroicon-o-clipboard-document-list')
            ->color('success')
            ->requiresConfirmation()
            ->modalHeading('Llenar Control Prenatal')
            ->modalDescription('¿Deseas proceder a llenar el control prenatal para este paciente?')
            ->modalSubmitActionLabel('Continuar')
            ->action(function () {
  
                    
                return redirect(ControlResource::getUrl('create', [
                    'antecedente_id' => $this->record->id
                ]));
            }),
        ];
    }
}
