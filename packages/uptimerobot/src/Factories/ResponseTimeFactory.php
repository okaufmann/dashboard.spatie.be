<?php
/**
 * ResponseTimeFactory.php, dashboard
 *
 * This File belongs to to Project dashboard
 *
 * @author Oliver Kaufmann <okaufmann91@gmail.com>
 * @version 1.0
 * @package YOUREOACKAGE
 */

namespace Okaufmann\UptimeRobot\Factories;


use Carbon\Carbon;

class ResponseTimeFactory extends AbstractFactory
{
    public $propertyFactories = [
        'datetime' => [
            'factory' => \Okaufmann\UptimeRobot\Factories\Common\DateTimeFactory::class,
            'type'    => Carbon::class
        ]
    ];
}