<?php
/**
 * Log.php, dashboard
 *
 * This File belongs to to Project dashboard
 *
 * @author Oliver Kaufmann <okaufmann91@gmail.com>
 * @version 1.0
 * @package YOUREOACKAGE
 */

namespace Okaufmann\UptimeRobot\Models;


use Carbon\Carbon;

class Log extends AbstractModel
{
    /**
     * Type of the logged event
     *
     * 1 - down
     * 2 - up
     * 99 - paused
     * 98 - started
     *
     * @var string
     */
    private $type;

    /**
     * @var Carbon
     */
    private $datetime;

    /**
     * @var array
     */
    private $alertContacts;

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return Carbon
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * @param Carbon $datetime
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;
    }

    /**
     * @return array
     */
    public function getAlertContacts()
    {
        return $this->alertContacts;
    }

    /**
     * @param array $alertContacts
     */
    public function setAlertContacts($alertContacts)
    {
        $this->alertContacts = $alertContacts;
    }
}