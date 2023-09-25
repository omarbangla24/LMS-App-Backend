<?php

namespace App\Filament\Resources\FileRequestResource\Pages;

use App\Filament\Resources\FileRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFileRequests extends ListRecords
{
    protected static string $resource = FileRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
