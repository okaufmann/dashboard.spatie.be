<?php
/**
 * Monitor.php, dashboard
 *
 * This File belongs to to Project dashboard
 *
 * @author Oliver Kaufmann <okaufmann91@gmail.com>
 * @version 1.0
 * @package YOUREOACKAGE
 */

namespace Okaufmann\UptimeRobot\Models;


use Illuminate\Support\Collection;

class Monitor extends AbstractModel
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $friendlyName;

    /**
     * @var string
     */
    private $url;

    /**
     * The type of the monitor.
     *
     * 1 - HTTP(s)
     * 2 - Keyword
     * 3 - Ping
     * 4 - Port
     *
     * @var integer
     */
    private $type;

    /**
     *
     * 1 - HTTP (80)
     * 2 - HTTPS (443)
     * 3 - FTP (21)
     * 4 - SMTP (25)
     * 5 - POP3 (110)
     * 6 - IMAP (143)
     * 99 - Custom Port
     *
     * @var integer
     */
    private $subType;

    /**
     * @var string
     */
    private $keywordType;

    /**
     * @var string
     */
    private $keywordValue;

    /**
     * @var string
     */
    private $httpUsername;

    /**
     * @var string
     */
    private $httpPassword;

    /**
     * @var string
     */
    private $port;

    /**
     * @var string
     */
    private $interval;

    /**
     * The status of the monitor. When used with the editMonitor method 0 (to pause) or 1 (to start) can be sent.
     * 0 - paused
     * 1 - not checked yet
     * 2 - up
     * 8 - seems down
     * 9 - down
     *
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $allTimeUpTimeRatio;

    /**
     * @var string
     */
    private $customUpTimeRatio;

    /**
     * @var array
     */
    private $alertContacts;

    /**
     * @var array
     */
    private $logs;

    /**
     * @var array
     */
    private $responseTimes;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFriendlyName()
    {
        return $this->friendlyName;
    }

    /**
     * @param string $friendlyName
     */
    public function setFriendlyName($friendlyName)
    {
        $this->friendlyName = $friendlyName;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

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
     * @return string
     */
    public function getSubType()
    {
        return $this->subType;
    }

    /**
     * @param string $subType
     */
    public function setSubType($subType)
    {
        $this->subType = $subType;
    }

    /**
     * @return string
     */
    public function getKeywordType()
    {
        return $this->keywordType;
    }

    /**
     * @param string $keywordType
     */
    public function setKeywordType($keywordType)
    {
        $this->keywordType = $keywordType;
    }

    /**
     * @return string
     */
    public function getKeywordValue()
    {
        return $this->keywordValue;
    }

    /**
     * @param string $keywordValue
     */
    public function setKeywordValue($keywordValue)
    {
        $this->keywordValue = $keywordValue;
    }

    /**
     * @return string
     */
    public function getHttpUsername()
    {
        return $this->httpUsername;
    }

    /**
     * @param string $httpUsername
     */
    public function setHttpUsername($httpUsername)
    {
        $this->httpUsername = $httpUsername;
    }

    /**
     * @return string
     */
    public function getHttpPassword()
    {
        return $this->httpPassword;
    }

    /**
     * @param string $httpPassword
     */
    public function setHttpPassword($httpPassword)
    {
        $this->httpPassword = $httpPassword;
    }

    /**
     * @return string
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param string $port
     */
    public function setPort($port)
    {
        $this->port = $port;
    }

    /**
     * @return string
     */
    public function getInterval()
    {
        return $this->interval;
    }

    /**
     * @param string $interval
     */
    public function setInterval($interval)
    {
        $this->interval = $interval;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getAllTimeUpTimeRatio()
    {
        return $this->allTimeUpTimeRatio;
    }

    /**
     * @param string $allTimeUpTimeRatio
     */
    public function setAllTimeUpTimeRatio($allTimeUpTimeRatio)
    {
        $this->allTimeUpTimeRatio = $allTimeUpTimeRatio;
    }

    /**
     * @return string
     */
    public function getCustomUpTimeRatio()
    {
        return $this->customUpTimeRatio;
    }

    /**
     * @param string $customUpTimeRatio
     */
    public function setCustomUpTimeRatio($customUpTimeRatio)
    {
        $this->customUpTimeRatio = $customUpTimeRatio;
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

    /**
     * @return Collection
     */
    public function getLogs()
    {
        return $this->logs;
    }

    /**
     * @param array $logs
     */
    public function setLogs($logs)
    {
        $this->logs = $logs;
    }

    /**
     * @return Collection
     */
    public function getResponseTimes()
    {
        return $this->responseTimes;
    }

    /**
     * @param array $responseTimes
     */
    public function setResponseTimes($responseTimes)
    {
        $this->responseTimes = $responseTimes;
    }
}