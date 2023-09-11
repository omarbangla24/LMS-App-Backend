<?php

namespace App\Filament\Resources\BusinessEventResource\Pages;

use App\Filament\Resources\BusinessEventResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBusinessEvents extends ListRecords
{
    protected static string $resource = BusinessEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
