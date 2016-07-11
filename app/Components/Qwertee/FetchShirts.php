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


use App\Components\Qwertee\Events\ShirtsFetched;
use Feeds;
use Illuminate\Console\Command;
use Symfony\Component\DomCrawler\Crawler;

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
        $feed = Feeds::make('https://www.qwertee.com/rss');

        $items = collect($feed->get_items())->sortByDesc(function (\SimplePie_Item $item, $key) {
            return $item->get_date("Ymd");
        })->take(3);

        $imageUrls = $items->map(function (\SimplePie_Item $item) {
            $crawler = new Crawler($item->get_content());
            $imageUrls = $crawler->filter('img')->each(function (Crawler $node, $i) {
                return $node->attr('src');
            });

            return $imageUrls;
        });

        event(new ShirtsFetched($imageUrls->flatten()->all()));
    }
}