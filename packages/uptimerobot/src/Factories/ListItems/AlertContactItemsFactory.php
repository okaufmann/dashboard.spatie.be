<?php
/**
 * LogItemsFactory.php, dashboard
 *
 * This File belongs to to Project dashboard
 *
 * @author Oliver Kaufmann <okaufmann91@gmail.com>
 * @version 1.0
 * @package YOUREOACKAGE
 */

namespace Okaufmann\UptimeRobot\Factories\ListItems;


use Okaufmann\UptimeRobot\Factories\AlertContactFactory;
use Okaufmann\UptimeRobot\Factories\Common\CollectionFactory;

class AlertContactItemsFactory extends CollectionFactory
{
    function getItemFactory()
    {
        return new AlertContactFactory();
    }
}