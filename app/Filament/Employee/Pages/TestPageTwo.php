<?php

namespace App\Filament\Employee\Pages;

class TestPageTwo extends BaseEmployeePage
{
    protected static ?string $navigationIcon = 'heroicon-o-table-cells';
    protected static ?string $navigationLabel = 'Test Page 2';
    protected static ?string $title = 'Test Page 2';
    protected static string $view = 'filament.employee.pages.test-page-two';

    protected static ?string $requiredPermission = 'employee_test_page_2_view';

    public array $rows = [];
    public bool $canAdd = false;
    public bool $canDelete = false;

    public function mount(): void
    {
        parent::mount(); 

        $this->rows = [
            ['id' => 1, 'name' => 'Row 1'],
            ['id' => 2, 'name' => 'Row 2'],
        ];

        $this->canAdd = auth()->user()?->can('employee_test_page_2_add');
        $this->canDelete = auth()->user()?->can('employee_test_page_2_delete');
    }

    public function addRow(): void
    {
        if (! $this->canAdd) return;
        $this->rows[] = ['id' => count($this->rows) + 1, 'name' => 'New row'];
    }

    public function deleteRow(int $id): void
    {
        if (! $this->canDelete) return;
        $this->rows = array_values(array_filter($this->rows, fn($r) => $r['id'] !== $id));
    }
}
