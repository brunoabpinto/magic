<?php

namespace Brunoabpinto\Magic;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class MagicServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Load package migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // Load package views (for the Livewire component)
        $this->loadViewsFrom(__DIR__.'/View/Components', 'magic');

        // Register the Livewire component
        Livewire::component('magic', \Brunoabpinto\Magic\Http\Livewire\MagicComponent::class);

        // Blade directive for @magic($value)
        Blade::directive('magic', function (string $expression) {
            return "<?php echo \\Livewire\\Livewire::mount('magic', ['originalValue' => $expression]); ?>";
        });

        // Publish configuration
        $this->publishes([
            __DIR__.'/../config/magic.php' => config_path('magic.php'),
        ], 'magic-config');

        // Publish migrations
        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'magic-migrations');

        // Publish CSS to public/vendor/magic
        $this->publishes([
            __DIR__.'/../resources/css/magic.css' => public_path('vendor/magic/magic.css'),
        ], 'magic-assets');

        $target = public_path('vendor/magic/magic.css');
        if (!file_exists($target)) {
            copy(__DIR__.'/../resources/css/magic.css', $target);
        }
    }

    public function register(): void
    {
        // Merge package config
        $this->mergeConfigFrom(
            __DIR__.'/../config/magic.php',
            'magic'
        );
    }
}
