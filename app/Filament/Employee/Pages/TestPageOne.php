<?php

namespace App\Filament\Employee\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Gate;

class TestPageOne extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-table-cells';
    protected static ?string $navigationLabel = 'Test Page 1';
    protected static ?string $title = 'Test Page 1';
    protected static string $view = 'filament.employee.pages.test-page-two';

    public bool $restricted = false;
    public array $rows = [];
    public bool $canAdd = false;
    public bool $canDelete = false;

    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }

    protected function authorizeAccess(): void
    {
        $this->authorize('employee_test_page_1_view');
    }

    public function mount(): void
    {
        try {
            $this->authorizeAccess();

            $this->rows = [
                ['id' => 1, 'name' => 'Row 1'],
                ['id' => 2, 'name' => 'Row 2'],
            ];

            $this->canAdd = Gate::allows('employee_test_page_1_add');
            $this->canDelete = Gate::allows('employee_test_page_1_delete');
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
            redirect()->to(RestrictedAccess::getUrl());
            return;
        }
    }
}