<?php

namespace Batyukovstudio\BatMedia\Filament\Resources\Media\MediaEntityResource\Pages;

use Batyukovstudio\BatMedia\Filament\Resources\Media\MediaEntityResource;
use Batyukovstudio\BatMedia\Filament\Traits\HasEditFormActions;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMediaEntity extends EditRecord
{
    use HasEditFormActions;

    protected static string $resource = MediaEntityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
