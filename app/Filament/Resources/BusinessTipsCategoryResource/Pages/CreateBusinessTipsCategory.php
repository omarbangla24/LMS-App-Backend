<?php

namespace App\Filament\Resources\BusinessTipsCategoryResource\Pages;

use App\Filament\Resources\BusinessTipsCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBusinessTipsCategory extends CreateRecord
{
    protected static string $resource = BusinessTipsCategoryResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
