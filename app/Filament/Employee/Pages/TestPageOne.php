<?php

namespace App\Filament\Employee\Pages;

use Filament\Pages\Page;

class TestPageOne extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-beaker';
    protected static ?string $title = 'Test Page 1';
    protected static string $view = 'filament.employee.pages.test-page-one';

    public array $rows = [];

    public function mount(): void
    {
        $this->rows = [
            ['id' => 1, 'name' => 'Alpha'],
            ['id' => 2, 'name' => 'Beta'],
            ['id' => 3, 'name' => 'Gamma'],
        ];
    }

    // Always register navigation (so page always appears in sidebar)
    public static function shouldRegisterNavigation(): bool
    {
        return auth()->check();
    }
}
