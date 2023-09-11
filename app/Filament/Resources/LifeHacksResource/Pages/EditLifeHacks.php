<?php

namespace App\Filament\Resources\LifeHacksResource\Pages;

use App\Filament\Resources\LifeHacksResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLifeHacks extends EditRecord
{
    protected static string $resource = LifeHacksResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
