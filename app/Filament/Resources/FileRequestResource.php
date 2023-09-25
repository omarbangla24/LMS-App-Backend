<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FileRequestResource\Pages;
use App\Filament\Resources\FileRequestResource\RelationManagers;
use App\Models\FileRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FileRequestResource extends Resource
{
    protected static ?string $model = FileRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'File Requests';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //user relation
                Forms\Components\BelongsToSelect::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->placeholder('Select User'),
                //file relation
                Forms\Components\BelongsToSelect::make('file_id')
                    ->relationship('file', 'name')
                    ->required()
                    ->placeholder('Select File'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.id')
                ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('file.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->sortable(),
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
            'index' => Pages\ListFileRequests::route('/'),
            'create' => Pages\CreateFileRequest::route('/create'),
            'edit' => Pages\EditFileRequest::route('/{record}/edit'),
        ];
    }
}
