<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BusinessEventResource\Pages;
use App\Filament\Resources\BusinessEventResource\RelationManagers;
use App\Models\BusinessEvent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BusinessEventResource extends Resource
{
    protected static ?string $model = BusinessEvent::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'App Features';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                ->required()
                ->columnSpan([
                    'sm' => 1,
                    'xl' => 3,
                    '2xl' => 4,
                ]),
                Forms\Components\DatePicker::make('date')
                ->native(false)
                ->columns([
                    'sm' => 1,
                    'xl' => 3,
                    '2xl' => 4,
                ]),
                Forms\Components\TimePicker::make('time')
                ->seconds(false)
                ->native(false)
                 ->columns([
                    'sm' => 1,
                    'xl' => 3,
                    '2xl' => 4,
                ]),
                Forms\Components\Select::make('location')
                ->options([
                    'Dhaka' => 'Dhaka',
                    'Chattagram' => 'Chattagram',
                    'Khulna' => 'Khulna',
                    'Barisal' => 'Barisal',
                    'Sylhet' => 'Sylhet',
                    'Rangpur' => 'Rangpur',
                    'Mymensingh' => 'Mymensingh',
                ])
                ->native(false)
                 ->columnSpan([
                    'sm' => 1,
                    'xl' => 3,
                    '2xl' => 4,
                ]),
                Forms\Components\FileUpload::make('image')
                ->columnSpan([
                    'sm' => 1,
                    'xl' => 3,
                    '2xl' => 4,
                ]),
                Forms\Components\RichEditor::make('description')
                ->required()
                ->columnSpan([
                    'sm' => 1,
                    'xl' => 3,
                    '2xl' => 4,
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                ->searchable(),
                Tables\Columns\TextColumn::make('date'),
                Tables\Columns\TextColumn::make('time'),
                Tables\Columns\TextColumn::make('location'),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('description')
                ->wrap()
                ->words(30),
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
            'index' => Pages\ListBusinessEvents::route('/'),
            'create' => Pages\CreateBusinessEvent::route('/create'),
            'edit' => Pages\EditBusinessEvent::route('/{record}/edit'),
        ];
    }
}
