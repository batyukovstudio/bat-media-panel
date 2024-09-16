<?php

namespace Batyukovstudio\BatMedia\Filament\Resources\Media\MediaEntityConversionResource\Pages;

use Batyukovstudio\BatMedia\Filament\Resources\Media\MediaEntityConversionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMediaEntityConversions extends ListRecords
{
    protected static string $resource = MediaEntityConversionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
