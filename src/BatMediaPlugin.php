<?php

namespace Batyukovstudio\BatMedia;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Batyukovstudio\BatMedia\Filament\Resources;
use Batyukovstudio\BatMedia\Filament\Components;
use Batyukovstudio\BatMedia\Filament\Traits;

class BatMediaPlugin implements Plugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }

    public function getId(): string
    {
        return 'bat-media-panel';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->resources([
                Resources\Media\MediaEntityConversionResource::class,
                Resources\Media\MediaConversionSizeResource::class,
                Resources\Media\MediaEntityResource::class,
            ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}