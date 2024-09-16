<?php

namespace Batyukovstudio\BatMedia\Filament\Resources\Media\MediaConversionSizeResource\Pages;

use Batyukovstudio\BatMedia\Filament\Resources\Media\MediaConversionSizeResource;
use Batyukovstudio\BatMedia\Filament\Traits\HasEditFormActions;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMediaConversionSize extends EditRecord
{
    use HasEditFormActions;

    protected static string $resource = MediaConversionSizeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
