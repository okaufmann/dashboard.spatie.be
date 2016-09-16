<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Components\GitHub\FetchGitHubFileContent::class,
        \App\Components\GoogleCalendar\FetchGoogleCalendarEvents::class,
        \App\Components\LastFm\FetchCurrentTrack::class,
        \App\Components\Packagist\FetchTotals::class,
        \App\Components\InternetConnectionStatus\SendHeartbeat::class,
        \App\Components\RainForecast\FetchRainForecast::class,
        \App\Components\UptimeRobot\FetchMonitors::class,
        \App\Components\RlsNotifier\FetchStats::class,
        \App\Components\Qwertee\FetchShirts::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('dashboard:lastfm')->everyMinute();
        $schedule->command('dashboard:calendar')->everyFiveMinutes();
        $schedule->command('dashboard:rls-notifier')->hourly();
        //$schedule->command('dashboard:github')->everyFiveMinutes();
        $schedule->command('dashboard:heartbeat')->everyMinute();
        $schedule->command('dashboard:packagist')->hourly();
        $schedule->command('dashboard:rain')->everyMinute();
        $schedule->command('dashboard:uptimerobot')->everyMinute();
        $schedule->command('dashboard:qwertee')
            ->everyThirtyMinutes()
            ->timezone('Europe/Zurich')
            ->when(function () {
                $hour = date('H');
                return ($hour >= 22 && $hour <= 23) || $hour = 0;
            });
    }
}
