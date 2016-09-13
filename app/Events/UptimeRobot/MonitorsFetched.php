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

namespace App\Events\UptimeRobot;

use App\Events\DashboardEvent;

class MonitorsFetched extends DashboardEvent
{
    /**
     * @var
     */
    public $allTimeUptimeRatio;
    /**
     * @var
     */
    public $monitorsUp;
    /**
     * @var
     */
    public $monitorsDown;
    /**
     * @var
     */
    public $monitorsDownData;

    /**
     * MonitorsFetched constructor.
     *
     * @param $allTimeUptimeRatio
     * @param $monitorsUp
     * @param $monitorsDown
     * @param $monitorsDownData
     *
     */
    public function __construct($allTimeUptimeRatio, $monitorsUp, $monitorsDown, $monitorsDownData)
    {
        $this->allTimeUptimeRatio = $allTimeUptimeRatio;
        $this->monitorsUp = $monitorsUp;
        $this->monitorsDown = $monitorsDown;
        $this->monitorsDownData = $monitorsDownData;
    }
}