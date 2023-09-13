<?php

namespace App\Filament\Resources\BusinessTipsResource\Pages;

use App\Filament\Resources\BusinessTipsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBusinessTips extends EditRecord
{
    protected static string $resource = BusinessTipsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
