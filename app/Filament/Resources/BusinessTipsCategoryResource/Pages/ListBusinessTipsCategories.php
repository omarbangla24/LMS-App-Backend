<?php

namespace App\Filament\Resources\BusinessTipsCategoryResource\Pages;

use App\Filament\Resources\BusinessTipsCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBusinessTipsCategories extends ListRecords
{
    protected static string $resource = BusinessTipsCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
