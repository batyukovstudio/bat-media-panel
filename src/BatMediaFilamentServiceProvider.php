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
        $this->registerPublishing();

    }

    public function register(): void
    {

        parent::register();
    }
    protected function registerPublishing()
    {

            $this->publishes([
                __DIR__.'/Filament' => './app/Filament',
            ], 'bat-components');
        }

}