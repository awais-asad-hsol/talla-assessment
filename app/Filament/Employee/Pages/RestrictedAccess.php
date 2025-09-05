<?php

namespace App\Filament\Employee\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Log;

class RestrictedAccess extends Page
{
    protected static ?string $navigationIcon = null;
    protected static ?string $navigationLabel = null;
    protected static string $view = 'filament.employee.pages.restricted-access';

    public static function getSlug(): string
    {
        return 'restricted-access';
    }

    public static function shouldRegisterNavigation(): bool
    {
        // Hide from sidebar
        return false;
    }

    protected function authorizeAccess(): void
    {
        Log::info('AuthorizeAccess in RestrictedAccess triggered');
        // Always allow access to this page
    }
}
