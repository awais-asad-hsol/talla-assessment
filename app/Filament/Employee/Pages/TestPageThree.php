<?php

namespace App\Filament\Employee\Pages;

class TestPageThree extends BaseEmployeePage
{
    protected static ?string $navigationIcon = 'heroicon-o-table-cells';
    protected static ?string $navigationLabel = 'Test Page 3';
    protected static ?string $title = 'Test Page 2';
    protected static string $view = 'filament.employee.pages.test-page-three';

    protected static ?string $requiredPermission = 'employee_test_page_3view';

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

        $this->canAdd = auth()->user()?->can('employee_test_page_3_add');
        $this->canDelete = auth()->user()?->can('employee_test_page_3_delete');
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
