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
    }

    public function register(): void
    {
        $this->registerPublishing();

        parent::register();
    }
    protected function registerPublishing()
    {
        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__.'/Filament' => app_path('Filament/'),
            ], 'bat-components');
        }
    }

}