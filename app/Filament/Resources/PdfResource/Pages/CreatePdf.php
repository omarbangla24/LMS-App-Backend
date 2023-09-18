<?php

namespace App\Filament\Resources\PdfResource\Pages;

use App\Filament\Resources\PdfResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePdf extends CreateRecord
{
    protected static string $resource = PdfResource::class;
}
