<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PdfResource\Pages;
use App\Filament\Resources\PdfResource\RelationManagers;
use App\Models\Pdf;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PdfResource extends Resource
{
    protected static ?string $model = Pdf::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Course';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Information')->schema([
                    Forms\Components\Select::make('course_id')
                    ->relationship('Course','title'),
                    Forms\Components\FileUpload::make('pdf_url') ->preserveFilenames(),
                    Forms\Components\TextInput::make('title'),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('Course.title')->color('danger'),
                Tables\Columns\TextColumn::make('pdf_url') ->limit(30),
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
            'index' => Pages\ListPdfs::route('/'),
            'create' => Pages\CreatePdf::route('/create'),
            'edit' => Pages\EditPdf::route('/{record}/edit'),
        ];
    }
}
