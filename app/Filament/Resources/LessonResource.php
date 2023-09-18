<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LessonResource\Pages;
use App\Filament\Resources\LessonResource\RelationManagers;
use App\Models\Lesson;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LessonResource extends Resource
{
    protected static ?string $model = Lesson::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Course';
    public static function form(Form $form): Form
    {
        return $form
        ->columns([
            'sm' => 3,
            'xl' => 6,
            '2xl' => 8,
        ])
            ->schema([

                Forms\Components\Section::make('Information')->schema([
                    Forms\Components\TextInput::make('video_link')
                    ->url()
                    ->prefixIcon('heroicon-m-globe-alt'),
                    Forms\Components\TextInput::make('title'),
                    Forms\Components\Textarea::make('description'),

                ]) ->columnSpan([
                    'sm' => 2,
                    'xl' => 3,
                    '2xl' => 4,
                ]),
                Forms\Components\Section::make('Information')->schema([
                    Forms\Components\Select::make('course_id')
                    ->relationship('Course','title'),
                    Forms\Components\TextInput::make('position')->numeric(),
                    Forms\Components\FileUpload::make('image'),
                    Forms\Components\Toggle::make('is_premium'),
                ]) ->columnSpan([
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
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('description') ->limit(30),
                Tables\Columns\TextColumn::make('Course.title')->color('danger'),
                Tables\Columns\TextColumn::make('position'),
                Tables\Columns\TextColumn::make('video_link') ->limit(30),
                Tables\Columns\ImageColumn::make('image'),
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
            'index' => Pages\ListLessons::route('/'),
            'create' => Pages\CreateLesson::route('/create'),
            'edit' => Pages\EditLesson::route('/{record}/edit'),
        ];
    }
}
