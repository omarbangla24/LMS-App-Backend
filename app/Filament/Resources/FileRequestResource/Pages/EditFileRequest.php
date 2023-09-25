<?php

namespace App\Filament\Resources\FileRequestResource\Pages;

use App\Filament\Resources\FileRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFileRequest extends EditRecord
{
    protected static string $resource = FileRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
