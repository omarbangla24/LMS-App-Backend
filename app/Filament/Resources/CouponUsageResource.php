<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Coupon;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\CouponUsage;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CouponUsageResource\Pages;
use App\Filament\Resources\CouponUsageResource\RelationManagers;

class CouponUsageResource extends Resource
{
    protected static ?string $model = CouponUsage::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Payment';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('Coupon.name'),
                Tables\Columns\TextColumn::make('Coupon.code'),
                Tables\Columns\TextColumn::make('Coupon.discount'),
                Tables\Columns\TextColumn::make('User.name'),
                Tables\Columns\TextColumn::make('User.id'),
                Tables\Columns\TextColumn::make('created_at'),
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
            'index' => Pages\ListCouponUsages::route('/'),
            'create' => Pages\CreateCouponUsage::route('/create'),
            'edit' => Pages\EditCouponUsage::route('/{record}/edit'),
        ];
    }
}
