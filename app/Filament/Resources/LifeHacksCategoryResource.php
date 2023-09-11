<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LifeHacksCategoryResource\Pages;
use App\Filament\Resources\LifeHacksCategoryResource\RelationManagers;
use App\Models\LifeHacksCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LifeHacksCategoryResource extends Resource
{
    protected static ?string $model = LifeHacksCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Life Hacks';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('life_cat_title')
                ->required()
                ->maxLength(255),
                Forms\Components\FileUpload::make('life_cat_img')
                ->required(),
                Forms\Components\Toggle::make('is_premium')
                ->onColor('success')
                ->offColor('danger'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('life_cat_title')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('life_cat_img'),
                Tables\Columns\ToggleColumn::make('is_premium'),


            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLifeHacksCategories::route('/'),
            'create' => Pages\CreateLifeHacksCategory::route('/create'),
            'edit' => Pages\EditLifeHacksCategory::route('/{record}/edit'),
        ];
    }
}
