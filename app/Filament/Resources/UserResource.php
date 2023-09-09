<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationGroup = 'Settings';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('email_verified_at'),
                Forms\Components\TextInput::make('mobile_no'),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                    ->dehydrated(fn (?string $state): bool => filled($state))
                    ->required(fn (string $operation): bool => $operation === 'create')
                    ->maxLength(255),
                Forms\Components\Select::make('roles')
                    ->relationship('roles', 'name')
                    ->searchable()
                    ->preload(),
                Forms\Components\TextInput::make('token'),
                Forms\Components\TextInput::make('address'),
                Forms\Components\TextInput::make('usertype'),
                Forms\Components\TextInput::make('age'),
                Forms\Components\TextInput::make('profile_image_path'),
                Forms\Components\TextInput::make('otp'),
                Forms\Components\TextInput::make('ref_code'),
                Forms\Components\TextInput::make('professions_id'),
                Forms\Components\TextInput::make('bkash_mobile'),
                Forms\Components\TextInput::make('trans_id'),
                Forms\Components\TextInput::make('trans_date'),
                Forms\Components\TextInput::make('amount'),
                Forms\Components\TextInput::make('status'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('mobile_no'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('token')
                ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('address')
                ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('usertype'),
                Tables\Columns\TextColumn::make('age')
                ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('profile_image_path')
                ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('otp')
                ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('ref_code')
                ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('professions_id')
                ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('bkash_mobile')
                ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('trans_id')
                ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('trans_date')
                ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('amount')
                ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('status')
                ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
    // public static function getEloquentQuery(): Builder
    // {
    //     return parent::getEloquentQuery()->where('name', '!=' , 'Admin');
    // }
}
