<?php
/**
 * FetchRlsNotifierStats.php, dashboard
 *
 * This File belongs to to Project dashboard
 *
 * @author Oliver Kaufmann <okaufmann91@gmail.com>
 * @version 1.0
 * @package YOUREOACKAGE
 */

namespace App\Components\RlsNotifier;

use App\Events\RlsNotifier\StatisticsFetched;
use GuzzleHttp\Client as HttpClient;
use Illuminate\Console\Command;

class FetchStats extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'dashboard:rls-notifier';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch statistics from rls notifier.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $url = config('services.rls-notifier.host').'/api/v1/statistics/releases?api_token=' . config('services.rls-notifier.key');

        $data = (new HttpClient)->get($url);
        $jsonData = json_decode((string) $data->getBody(), true);

        event(new StatisticsFetched($jsonData));
    }
}