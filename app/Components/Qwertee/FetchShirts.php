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

namespace App\Components\Qwertee;


use App\Events\Qwertee\ShirtsFetched;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Okaufmann\Qwertee\Qwertee;

class FetchShirts extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'dashboard:qwertee';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch actual shirt motives.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $tees = Qwertee::today();

        $imageUrls = $tees->map(function (Collection $tee) {

            return $tee['mens'];
        });

        event(new ShirtsFetched($imageUrls->flatten()->all()));
    }
}