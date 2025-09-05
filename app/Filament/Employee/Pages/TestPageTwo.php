<?php

namespace App\Filament\Employee\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;

class TestPageTwo extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-table-cells';
    protected static ?string $navigationLabel = 'Test Page 2';
    protected static ?string $title = 'Test Page 2';
    protected static string $view = 'filament.employee.pages.test-page-two';

    public array $rows = [];
    public bool $canAdd = false;
    public bool $canDelete = false;

    public static function shouldRegisterNavigation(): bool
    {
        // Always show in sidebar
        return true;
    }

    protected function authorizeAccess(): void
    {
        dd(Gate::allows('employee_test_page_2_view'));
        Log::info('AuthorizeAccess in TestPageTwo triggered');

        if (! Gate::allows('employee_test_page_2_view')) {
            Log::info('User not allowed, redirecting to restricted page');
            throw new HttpResponseException(
                redirect('/employee/restricted-access')
            );
        }
    }

    public function mount(): void
    {
        // authorizeAccess() runs first, so only authorized users reach here
        $this->rows = [
            ['id' => 1, 'name' => 'Row 1'],
            ['id' => 2, 'name' => 'Row 2'],
        ];

        $this->canAdd = Gate::allows('employee_test_page_2_add');
        $this->canDelete = Gate::allows('employee_test_page_2_delete');
    }

    public function addRow(): void
    {
        if (! Gate::allows('employee_test_page_2_add')) {
            return;
        }

        $this->rows[] = ['id' => count($this->rows) + 1, 'name' => 'New row'];
    }

    public function deleteRow(int $id): void
    {
        if (! Gate::allows('employee_test_page_2_delete')) {
            return;
        }

        $this->rows = array_values(array_filter($this->rows, fn($r) => $r['id'] !== $id));
    }
}
