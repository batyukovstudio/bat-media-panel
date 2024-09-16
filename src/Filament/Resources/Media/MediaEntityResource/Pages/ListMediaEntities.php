<?php

namespace Batyukovstudio\BatMedia\Filament\Resources\Media\MediaEntityResource\Pages;

use Batyukovstudio\BatMedia\Filament\Resources\Media\MediaEntityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMediaEntities extends ListRecords
{
    protected static string $resource = MediaEntityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
