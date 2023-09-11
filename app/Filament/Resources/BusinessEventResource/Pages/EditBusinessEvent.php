<?php

namespace App\Filament\Resources\BusinessEventResource\Pages;

use App\Filament\Resources\BusinessEventResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBusinessEvent extends EditRecord
{
    protected static string $resource = BusinessEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
