<?php

namespace Batyukovstudio\BatMedia\Providers;

use Illuminate\Support\ServiceProvider;


class BatMediaServiceProvider extends ServiceProvider
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
            __DIR__.'/Filament/Components' => public_path('app/Filament/Components'),
        ], 'bat-components');
    }

    public function register(): void
    {
        parent::register();
    }

}