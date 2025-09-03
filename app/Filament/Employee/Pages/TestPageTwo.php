<?php

namespace App\Filament\Employee\Pages;

use Filament\Pages\Page;

class TestPageTwo extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-beaker';
    protected static ?string $title = 'Test Page 2';
    protected static string $view = 'filament.employee.pages.test-page-two';

    public array $rows = [];

    public function mount(): void
    {
        // Static dummy data, no database queries
        $this->rows = [
            ['id' => 1, 'name' => 'Alpha'],
            ['id' => 2, 'name' => 'Beta'],
            ['id' => 3, 'name' => 'Gamma'],
        ];
    }
}
