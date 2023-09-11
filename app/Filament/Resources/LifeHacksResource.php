<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LifeHacksResource\Pages;
use App\Filament\Resources\LifeHacksResource\RelationManagers;
use App\Models\LifeHacks;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LifeHacksResource extends Resource
{
    protected static ?string $model = LifeHacks::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Life Hacks';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('life_hacks_cat_id')
                ->relationship('LifeHacksCategory', 'life_cat_title')
                ->searchable()
                ->preload()
                ->columnSpan([
                    'sm' => 2,
                    'xl' => 3,
                    '2xl' => 4,
                ]),
                Forms\Components\Textarea::make('life_hacks_text')
                ->required()
                ->columnSpan([
                    'sm' => 2,
                    'xl' => 3,
                    '2xl' => 4,
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('life_hacks_cat_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('life_hacks_text'),
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
            'index' => Pages\ListLifeHacks::route('/'),
            'create' => Pages\CreateLifeHacks::route('/create'),
            'edit' => Pages\EditLifeHacks::route('/{record}/edit'),
        ];
    }
}
