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

namespace App\Events\Qwertee;

use App\Events\DashboardEvent;

class ShirtsFetched extends DashboardEvent
{
    /**
     * @var array
     */
    public $tees;

    /**
     * MonitorsFetched constructor.
     *
     * @param array $tees
     */
    public function __construct(array $tees)
    {
        $this->tees = $tees;
    }
}