<?php

namespace App\Filament\Resources\BusinessTipsCategoryResource\Pages;

use App\Filament\Resources\BusinessTipsCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBusinessTipsCategory extends EditRecord
{
    protected static string $resource = BusinessTipsCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
