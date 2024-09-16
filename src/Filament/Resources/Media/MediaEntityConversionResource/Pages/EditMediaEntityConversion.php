<?php

namespace Batyukovstudio\BatMedia\Filament\Resources\Media\MediaEntityConversionResource\Pages;

use Batyukovstudio\BatMedia\Filament\Resources\Media\MediaEntityConversionResource;
use Batyukovstudio\BatMedia\Filament\Traits\HasEditFormActions;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMediaEntityConversion extends EditRecord
{
    use HasEditFormActions;

    protected static string $resource = MediaEntityConversionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
