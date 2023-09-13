<?php

namespace App\Filament\Resources\EbookCategoryResource\Pages;

use App\Filament\Resources\EbookCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEbookCategory extends CreateRecord
{
    protected static string $resource = EbookCategoryResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
