<?php
/**
 * NotSupportedException.php, dashboard
 *
 * This File belongs to to Project dashboard
 *
 * @author Oliver Kaufmann <okaufmann91@gmail.com>
 * @version 1.0
 * @package YOUREOACKAGE
 */

namespace Okaufmann\UptimeRobot\Exceptions;


class NotSupportedException extends ArgumentException
{
    private $message = "Invalid argument supplied: %s";

    public function __construct($arguments)
    {
        parent::__construct($this->message, $arguments);
    }
}