<?php

namespace App\Filament\Employee\Pages;

use Filament\Pages\Page;

class RestrictedAccess extends Page
{
    protected static ?string $navigationIcon = null;
    protected static ?string $navigationLabel = null;
    protected static string $view = 'filament.employee.pages.restricted-access';

    public static function shouldRegisterNavigation(): bool
    {
        // Don’t show in sidebar
        return false;
    }
}
