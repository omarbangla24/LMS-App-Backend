<?php

namespace App\Filament\Resources\LifeHacksResource\Pages;

use App\Filament\Resources\LifeHacksResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLifeHacks extends CreateRecord
{
    protected static string $resource = LifeHacksResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
