<?php
/**
 * ResponseTime.php, dashboard
 *
 * This File belongs to to Project dashboard
 *
 * @author Oliver Kaufmann <okaufmann91@gmail.com>
 * @version 1.0
 * @package YOUREOACKAGE
 */

namespace Okaufmann\UptimeRobot\Models;


use Carbon\Carbon;

class ResponseTime extends AbstractModel
{
    /**
     * @var Carbon
     */
    private $datetime;

    /**
     * @var int
     */
    private $value;

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
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param int $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}