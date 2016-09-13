<?php
/**
 * UptimeRobot.php, dashboard
 *
 * This File belongs to to Project dashboard
 *
 * @author Oliver Kaufmann <okaufmann91@gmail.com>
 * @version 1.0
 * @package YOUREOACKAGE
 */

namespace App\Components\UptimeRobot;

use App;
use App\Events\UptimeRobot\MonitorsFetched;
use Cache;
use Illuminate\Console\Command;
use Okaufmann\UptimeRobot\Client;
use Okaufmann\UptimeRobot\Models\Log;
use Okaufmann\UptimeRobot\Models\Monitor;
use Okaufmann\UptimeRobot\Models\Queries\MonitorsQuery;

class FetchMonitors extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'dashboard:uptimerobot';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch monitor status.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /** @var Client $client */
        $client = App::make('uptimerobot.client');

        //1. get all monitors ids
        $monitorIds = Cache::remember('monitorIds', 30, function () use ($client) {
            $monitors = $client->getMonitors();

            return $monitors->getMonitors()->map(function (Monitor $monitor) {
                return $monitor->getId();
            })->all();
        });

        //2. get all monitors by its it (otherwise they are cached and not live!)
        $query = new MonitorsQuery();
        $query->monitors = $monitorIds;
        $query->statuses = [2, 9];
        $query->logs = true;
        $query->responseTimesAverage = true;
        $query->alertContacts = true;
        $query->showMonitorAlertContacts = true;

        $monitors = $client->getMonitors($query);

        $allTimeUptimeRatio = $monitors->getMonitors()->map(function (Monitor $monitor) {
            return [
                'allTimeUpTimeRatio' => $monitor->getAllTimeUpTimeRatio()
            ];
        })->avg('allTimeUpTimeRatio');

        $upMonitorsCount = $monitors->getMonitors()->filter(function (Monitor $monitor) {
            return $monitor->getStatus() == 2;
        })->count();

        $downMonitors = $monitors->getMonitors()->filter(function (Monitor $monitor) {
            return $monitor->getStatus() == 9;
        });

        $downMonitorsCount = $downMonitors->count();

        $downMonitorsData = $downMonitors->map(function (Monitor $monitor) {
            $downSince = $monitor->getLogs()->filter(function (Log $log) {
                return $log->getType() == 1;
            })->first();

            return [
                'name'               => $monitor->getFriendlyName(),
                'url'                => $monitor->getUrl(),
                'id'                 => $monitor->getId(),
                'allTimeUpTimeRatio' => $monitor->getAllTimeUpTimeRatio(),
                'downSince'          => $downSince->getDatetime()->toIso8601String()
            ];
        })->values()->all();

        event(new MonitorsFetched($allTimeUptimeRatio, $upMonitorsCount, $downMonitorsCount, $downMonitorsData));
    }
}