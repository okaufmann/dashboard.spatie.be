<?php
/**
 * LogFactory.php, dashboard
 *
 * This File belongs to to Project dashboard
 *
 * @author Oliver Kaufmann <okaufmann91@gmail.com>
 * @version 1.0
 * @package YOUREOACKAGE
 */

namespace Okaufmann\UptimeRobot\Factories;


class LogFactory extends AbstractFactory
{
    public $propertyFactories = [
        'alertContacts'          => [
            'factory' => \Okaufmann\UptimeRobot\Factories\ListItems\AlertContactItemsFactory::class,
            'type'    => \Okaufmann\UptimeRobot\Models\AlertContact::class
        ],'datetime' => [
            'factory' => \Okaufmann\UptimeRobot\Factories\Common\DateTimeFactory::class,
            'type'    => Carbon::class
        ]
    ];

    public $propertyMappings = [
        'alertcontact'       => 'alertContacts'
    ];
}