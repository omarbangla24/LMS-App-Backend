<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Course;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\CourseCategory;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CourseResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CourseResource\RelationManagers;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

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
                    Forms\Components\TextInput::make('title')
                    ->required(),
                    Forms\Components\Textarea::make('description'),
                    Forms\Components\FileUpload::make('image'),

                ]) ->columnSpan([
                    'sm' => 2,
                    'xl' => 3,
                    '2xl' => 4,
                ]),
                Forms\Components\Section::make('Course')->schema([

                    Forms\Components\Select::make('course_category_id')
                    ->relationship('CourseCategory', 'title'),
                    Forms\Components\Select::make('user_id')
                    ->relationship('User', 'name',
                    fn (Builder $query) => $query->where('usertype', 'instructor'))
                    ->searchable()
                    ->preload(),

                    Forms\Components\TextInput::make('duration'),
                    Forms\Components\Toggle::make('status'),

                ])->columnSpan([
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
                Tables\Columns\TextColumn::make('CourseCategory.title'),
                Tables\Columns\TextColumn::make('CourseCategory.title'),
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('description')->limit(50),
                Tables\Columns\TextColumn::make('duration'),
                Tables\Columns\ToggleColumn::make('status'),
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
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }
}
