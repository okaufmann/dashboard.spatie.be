<?php
/**
 * ServiceProvider.php, dashboard
 *
 * This File belongs to to Project dashboard
 *
 * @author Oliver Kaufmann <okaufmann91@gmail.com>
 * @version 1.0
 * @package YOUREOACKAGE
 */

namespace Okaufmann\UptimeRobot;

use Illuminate\Container\Container;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;

class UptimeRobotServiceProvider  extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $this->setupConfig();

        $this->publishes([
            realpath(__DIR__.'/../config/uptimerobot.php') => config_path('uptimerobot.php'),
        ]);
    }

    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__.'/../config/uptimerobot.php');
        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('uptimerobot.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('uptimerobot');
        }
        $this->mergeConfigFrom($source, 'uptimerobot');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerClient();
    }

    /**
     * Register the auth factory class.
     *
     * @return void
     */
    protected function registerClient()
    {
        $this->app->singleton('uptimerobot.client', function (Container $app) {
            return new Client($app['config']);
        });
        $this->app->alias('uptimerobot.client', Client::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return ['uptimerobotclient.client'];
    }

}