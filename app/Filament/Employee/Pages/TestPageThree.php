<?php

namespace App\Filament\Employee\Pages;

use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Gate;

class TestPageThree extends Page implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-table-cells';
    protected static ?string $title = 'Test Page 3';
    protected static string $view = 'filament.employee.pages.test-page-three';

    public static function shouldRegisterNavigation(): bool
    {
        return true;
        return Gate::allows('employee_test_page_3_view');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(fn () => collect([
                (object) ['id' => 1, 'name' => 'Row 1'],
                (object) ['id' => 2, 'name' => 'Row 2'],
            ]))
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID'),
                Tables\Columns\TextColumn::make('name')->label('Name'),
            ])
            ->headerActions([
                Action::make('add')
                    ->label('Add')
                    ->visible(fn () => Gate::allows('employee_test_page_3_add'))
                    ->action(fn () => $this->notify('success', 'Add clicked!')),
            ])
            ->actions([
                Action::make('delete')
                    ->label('Delete')
                    ->visible(fn () => Gate::allows('employee_test_page_3_delete'))
                    ->action(fn () => $this->notify('danger', 'Delete clicked!')),
            ]);
    }
}
