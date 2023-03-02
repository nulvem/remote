<?php

namespace Nulvem\Remote;

use Illuminate\Support\ServiceProvider;
use Nulvem\Remote\Commands\MakeRemoteScript;

class RemoteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        view()->addLocation(config('remote.scripts_path'));

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/remote.php' => config_path('remote.php'),
            ], 'config');
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/remote.php', 'remote');

        $this->app->bind('command.make:remote-script', MakeRemoteScript::class);

        $this->commands([
            'command.make:remote-script',
        ]);
    }
}
