<?php

namespace App\Filament\Resources\LifeHacksResource\Pages;

use App\Filament\Resources\LifeHacksResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLifeHacks extends ListRecords
{
    protected static string $resource = LifeHacksResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
