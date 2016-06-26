<?php
/**
 * ArgumentException.php, dashboard
 *
 * This File belongs to to Project dashboard
 *
 * @author Oliver Kaufmann <okaufmann91@gmail.com>
 * @version 1.0
 * @package YOUREOACKAGE
 */

namespace Okaufmann\UptimeRobot\Exceptions;


class ArgumentException extends \Exception
{
    public function __construct($message, $arguments)
    {
        $args = "";
        if (is_array($arguments)) {
            $args = implode(", ", $arguments);
        } else {
            if (empty($arguments)) {
                $args = (string) $arguments;
            }
        }

        parent::__construct(sprintf($message, $args), 1);
    }

}