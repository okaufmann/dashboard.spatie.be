<?php
/**
 * MonitorsQuery.php, dashboard
 *
 * This File belongs to to Project dashboard
 *
 * @author Oliver Kaufmann <okaufmann91@gmail.com>
 * @version 1.0
 * @package YOUREOACKAGE
 */

namespace Okaufmann\UptimeRobot\Models\Queries;


class MonitorsQuery
{
    /**
     * @var array
     */
    public $monitors = null;

    /**
     * @var array
     */
    public $types = null;

    /**
     * @var array
     */
    public $statuses = null;

    /**
     * Defines the number of days to calculate the Uptime ratio(s)
     * For Ex: customUptimeRatio=7-30-45 to get the uptime ratios for those periods
     *
     * @var array
     */
    public $customUptimeRatio = null;

    /**
     * @var boolean
     */
    public $logs = null;

    /**
     * The number of logs to be returned (descending order). If empty, all logs are returned.
     *
     * @var integer
     */
    public $logsLimit = null;
    public $responseTimes = null;

    /**
     * The number of response time logs to be returned (descending order).
     * If empty, last 24 hours of logs are returned (if responseTimesStartDate and responseTimesEndDate are not used).
     *
     * @var integer
     */
    public $responseTimesLimit = null;

    public $responseTimesAverage = null;

    /**
     * Format: 2015-04-23
     *
     * @var string
     */
    public $responseTimesStartDate = null;

    /**
     * Format: 2015-04-23
     *
     * @var string
     */
    public $responseTimesEndDate = null;
    public $alertContacts = null;
    public $showMonitorAlertContacts = null;
    public $showTimezone = null;
    public $offset = null;
    public $limit = null;
    public $search = null;
}