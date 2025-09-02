<?php

namespace App\Filament\Employee\Pages;

use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Collection;

class TestPageTwo extends Page implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-table-cells';
    protected static ?string $title = 'Test Page 2';
    protected static string $view = 'filament.employee.pages.test-page-two';

    public static function shouldRegisterNavigation(): bool
    {
        // Only show in sidebar if employee has view permission
        return Gate::allows('employee_test_page_2_view');
    }

    /**
     * Build a fake query from static rows.
     */
    protected function getDummyQuery(): Builder
    {
        // Inline fake model
        $model = new class extends Model {
            protected $table = null;
            public $timestamps = false;
            protected $fillable = ['id', 'name'];
        };

        // Convert static collection to an Eloquent query
        $items = collect([
            new $model(['id' => 1, 'name' => 'Row 1']),
            new $model(['id' => 2, 'name' => 'Row 2']),
        ]);

        // Use Collection's toBase() wrapped in a QueryBuilder
        return $model->newQuery()->setModel($model)->getQuery()->fromSub(
            $items->map(fn ($item) => (array) $item)->all(),
            $model->getTable()
        );
    }

    public function table(Table $table): Table
    {
        return $table
            ->query($this->getDummyQuery())
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID'),
                Tables\Columns\TextColumn::make('name')->label('Name'),
            ])
            ->headerActions([
                Action::make('add')
                    ->label('Add')
                    ->visible(fn () => Gate::allows('employee_test_page_2_add'))
                    ->action(fn () => $this->notify('success', 'Add clicked!')),
            ])
            ->actions([
                Action::make('delete')
                    ->label('Delete')
                    ->visible(fn () => Gate::allows('employee_test_page_2_delete'))
                    ->action(fn () => $this->notify('danger', 'Delete clicked!')),
            ]);
    }
}
