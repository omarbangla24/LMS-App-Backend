<?php

namespace App\Filament\Resources\LifeHacksCategoryResource\Pages;

use App\Filament\Resources\LifeHacksCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLifeHacksCategories extends ListRecords
{
    protected static string $resource = LifeHacksCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
