<?php
/**
 * InvalidArgumentException.php, dashboard
 *
 * This File belongs to to Project dashboard
 *
 * @author Oliver Kaufmann <okaufmann91@gmail.com>
 * @version 1.0
 * @package YOUREOACKAGE
 */

namespace Okaufmann\UptimeRobot\Exceptions;

use Exception;

class ArgumentNullException extends Exception
{
    private $message = "Null argument supplied: %s";

    public function __construct($arguments)
    {
        parent::__construct($message, $arguments);
    }
}