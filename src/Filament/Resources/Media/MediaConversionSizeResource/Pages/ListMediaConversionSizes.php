<?php

namespace Batyukovstudio\BatMedia\Filament\Resources\Media\MediaConversionSizeResource\Pages;

use Batyukovstudio\BatMedia\Filament\Resources\Media\MediaConversionSizeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMediaConversionSizes extends ListRecords
{
    protected static string $resource = MediaConversionSizeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
