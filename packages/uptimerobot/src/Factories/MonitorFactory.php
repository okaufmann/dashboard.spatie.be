<?php

/**
 * MonitorFactory.php, dashboard
 *
 * This File belongs to to Project dashboard
 *
 * @author Oliver Kaufmann <okaufmann91@gmail.com>
 * @version 1.0
 * @package YOUREOACKAGE
 */

namespace Okaufmann\UptimeRobot\Factories;


class MonitorFactory extends AbstractFactory
{
    public $propertyFactories = [
        'alertContacts' => [
            'factory' => \Okaufmann\UptimeRobot\Factories\ListItems\AlertContactItemsFactory::class,
            'type'    => \Okaufmann\UptimeRobot\Models\AlertContact::class
        ],
        'logs'          => [
            'factory' => \Okaufmann\UptimeRobot\Factories\ListItems\LogItemsFactory::class,
            'type'    => \Okaufmann\UptimeRobot\Models\Log::class
        ],
        'responseTimes' => [
            'factory' => \Okaufmann\UptimeRobot\Factories\ListItems\ResponseTimeItemFactory::class,
            'type'    => \Okaufmann\UptimeRobot\Models\ResponseTime::class
        ]
    ];

    public $propertyMappings = [
        'log'                => 'logs',
        'responsetime'       => 'responseTimes',
        'friendlyname'       => 'friendlyName',
        'subtype'            => 'subType',
        'keywordtype'        => 'keywordType',
        'keywordvalue'       => 'keywordValue',
        'alltimeuptimeratio' => 'allTimeUpTimeRatio',
        'customuptimeratio'  => 'customUpTimeRatio',
        'httpusername'       => 'httpUsername',
        'httppassword'       => 'httpPassword',
        'alertcontact'       => 'alertContacts'

    ];
}