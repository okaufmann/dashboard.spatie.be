<?php
/**
 * MonitorsFetched.php, dashboard
 *
 * This File belongs to to Project dashboard
 *
 * @author Oliver Kaufmann <okaufmann91@gmail.com>
 * @version 1.0
 * @package YOUREOACKAGE
 */

namespace App\Components\Qwertee\Events;


use App\Components\DashboardEvent;

class ShirtsFetched extends DashboardEvent
{
    /**
     * @var
     */
    public $detailUrl;
    /**
     * @var
     */
    public $mensUrl;

    /**
     * MonitorsFetched constructor.
     *
     * @param $detailUrl
     * @param $mensUrl
s     */
    public function __construct($detailUrl, $mensUrl)
    {
        $this->detailUrl = $detailUrl;
        $this->mensUrl = $mensUrl;
    }
}