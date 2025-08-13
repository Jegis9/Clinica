<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Filament\Support\Facades\FilamentView;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        FilamentView::registerRenderHook(
            'panels::styles.before',
            fn () => '<style>
                .fi-sidebar-nav {
                    background-color: rgba(157, 193, 235, 1) !important;
                }
                .fi-sidebar-nav svg {
                    color: black !important;
                }
                .fi-ta-table thead th {
                    background-color: rgba(157, 193, 235, 1) !important;
                }
                .fi-table thead th {
                    color: rgba(157, 193, 235, 1) !important;
                }
                    .fi-ta-search-field{
                    border: 1px solid rgba(157, 193, 235, 1) !important;
                }
                .fi-simple-layout {
                    background-color: background: #803ae8;
                    background: radial-gradient(circle,rgba(128, 58, 232, 1) 0%, rgba(75, 75, 222, 1) 19%, rgba(157, 193, 235, 1) 100%); !important;
}
            </style>'
        );
    }
}
