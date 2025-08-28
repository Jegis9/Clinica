<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Histories;
use App\Models\Date;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Usuarios', User::count())
                ->icon('heroicon-o-users')
                ->description('Usuarios registrados')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
                



                

        ];
    }
}
