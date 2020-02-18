<?php

namespace App\Providers;

use App\Libraries\Extensions\Parsedown;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

class ExtendedParsedownServiceProvider extends \Parsedown\Providers\ParsedownServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton('parsedown', function () {
            $parsedown = Parsedown::instance();

            $parsedown->setBreaksEnabled(
                Config::get('parsedown.breaks_enabled')
            );

            $parsedown->setMarkupEscaped(
                Config::get('parsedown.markup_escaped')
            );

            $parsedown->setSafeMode(
                Config::get('parsedown.safe_mode')
            );

            $parsedown->setUrlsLinked(
                Config::get('parsedown.urls_linked')
            );

            return $parsedown;
        });

        $this->mergeConfigFrom(__DIR__ . '/../../vendor/parsedown/laravel/src/Support/parsedown.php', 'parsedown');
    }
}
