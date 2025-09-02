<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoleResource\Pages;
use App\Filament\Resources\RoleResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class RoleResource extends Resource
{
    protected static ?string $model = \Spatie\Permission\Models\Role::class;
    protected static ?string $navigationIcon = 'heroicon-o-shield-check';
    protected static ?string $navigationGroup = 'Access Control';


    // FORM (create/edit)
    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label('Role Name')
                ->required()
                ->unique(ignoreRecord: true),

            Forms\Components\TextInput::make('guard_name')
                ->default('web')
                ->required(),

            Forms\Components\Select::make('permissions')
                ->label('Assign Permissions')
                ->multiple()
                ->relationship('permissions', 'name') // Spatie relationship
                ->preload()
                ->searchable(),
        ]);
    }

    // TABLE (list all roles)
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Role Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('guard_name')->sortable(),
                Tables\Columns\TextColumn::make('permissions.name')
                    ->label('Permissions')
                    ->badge() // nice colored badges
                    ->separator(', '),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }
}
