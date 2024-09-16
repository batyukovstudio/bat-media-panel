<?php

namespace Batyukovstudio\BatMedia\Filament;

use Illuminate\Support\ServiceProvider;


class BatMediaFilamentServiceProvider extends ServiceProvider
{
    public array $serviceProviders = [
        // InternalServiceProviderExample::class,
    ];

    public array $aliases = [
        // 'Foo' => Bar::class,
    ];

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/Filament/Components' => 'app/Filament/Components',
        ], 'bat-components');
    }

    public function register(): void
    {
        parent::register();
    }

}