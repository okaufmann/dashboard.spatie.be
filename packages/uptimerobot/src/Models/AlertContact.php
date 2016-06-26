<?php
/**
 * AlertContact.php, dashboard
 *
 * This File belongs to to Project dashboard
 *
 * @author Oliver Kaufmann <okaufmann91@gmail.com>
 * @version 1.0
 * @package YOUREOACKAGE
 */

namespace Okaufmann\UptimeRobot\Models;

class AlertContact extends AbstractModel
{
    /**
     * @var integer
     */
    private $id;

    /**
     * The type of the alert contact notified (Zapier, HipChat and Slack are not supported in the newAlertContact method yet).
     * 1 - SMS
     * 2 - E-mail
     * 3 - Twitter DM
     * 4 - Boxcar
     * 5 - Web-Hook
     * 6 - Pushbullet
     * 7 - Zapier
     * 9 - Pushover
     * 10 - HipChat
     * 11 - Slack
     *
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $value;

    /**
     * Friendly name of the alert contact (for making it easier to distinguish from others).
     *
     * @var string
     */
    private $friendlyName;

    /**
     * The status of the alert contact.
     * 0 - not activated
     * 1 - paused
     * 2 - active
     *
     * @var int
     */
    private $status;

    /**
     * @var int
     */
    private $threshold;

    /**
     * @var int
     */
    private $recurrence;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getThreshold()
    {
        return $this->threshold;
    }

    /**
     * @param int $threshold
     */
    public function setThreshold($threshold)
    {
        $this->threshold = $threshold;
    }

    /**
     * @return int
     */
    public function getRecurrence()
    {
        return $this->recurrence;
    }

    /**
     * @param int $recurrence
     */
    public function setRecurrence($recurrence)
    {
        $this->recurrence = $recurrence;
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
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}