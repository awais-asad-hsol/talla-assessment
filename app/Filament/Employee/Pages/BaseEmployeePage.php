<?php

namespace App\Filament\Employee\Pages;

use Filament\Pages\Page;

abstract class BaseEmployeePage extends Page
{
    protected static ?string $requiredPermission = null;

    public function mount(): void
    {
        $can = auth()->user()?->can(static::$requiredPermission) ?? false;

        if (! $can) {
            // ✅ Use Livewire redirect
            $this->redirect(RestrictedAccess::getUrl());
        }
    }
}
