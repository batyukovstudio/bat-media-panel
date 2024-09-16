<?php

namespace Batyukovstudio\BatMedia\Filament\Traits;

trait HasEditFormActions
{
    public function getFormActions(): array
    {
        return [
            $this->getSaveFormAction()
                ->formId(id: 'form')
                ->extraAttributes([
                    'style' => 'position: fixed; bottom: 20px; right: 28px; z-index: 10;',
                ]),
            $this->getCancelFormAction()
        ];
    }
}
