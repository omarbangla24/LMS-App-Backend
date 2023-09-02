<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FranchiseResource\Pages;
use App\Filament\Resources\FranchiseResource\RelationManagers;
use App\Models\Franchise;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FranchiseResource extends Resource
{
    protected static ?string $model = Franchise::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('comp_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('comp_image')
                    ->image()
                    ->required(),
                Forms\Components\TextInput::make('comp_email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('comp_mobile')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('comp_url')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('comp_details')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('position')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('comp_name')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('comp_image'),
                Tables\Columns\TextColumn::make('comp_email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('comp_mobile')
                    ->searchable(),
                Tables\Columns\TextColumn::make('comp_url')
                    ->searchable(),
                Tables\Columns\TextColumn::make('position')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListFranchises::route('/'),
            'create' => Pages\CreateFranchise::route('/create'),
            'edit' => Pages\EditFranchise::route('/{record}/edit'),
        ];
    }    
}
