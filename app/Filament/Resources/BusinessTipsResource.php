<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\BusinessTips;
use Filament\Resources\Resource;
use App\Models\BusinessTipsCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BusinessTipsResource\Pages;
use App\Filament\Resources\BusinessTipsResource\RelationManagers;

class BusinessTipsResource extends Resource
{
    protected static ?string $model = BusinessTips::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Extra';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\select::make('business_tips_category_id')
                ->relationship('BusinessTipsCategory', 'name')
                ->required(),
                Forms\Components\TextInput::make('title')
                ->required(),
                Forms\Components\RichEditor::make('description')
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('BusinessTipsCategory.name')
                ->searchable(),
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('description')
                ->wrap(),
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
            'index' => Pages\ListBusinessTips::route('/'),
            'create' => Pages\CreateBusinessTips::route('/create'),
            'edit' => Pages\EditBusinessTips::route('/{record}/edit'),
        ];
    }
}
