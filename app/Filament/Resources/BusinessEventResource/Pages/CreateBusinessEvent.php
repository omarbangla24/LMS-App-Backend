<?php

namespace App\Filament\Resources\BusinessEventResource\Pages;

use App\Filament\Resources\BusinessEventResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBusinessEvent extends CreateRecord
{
    protected static string $resource = BusinessEventResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
