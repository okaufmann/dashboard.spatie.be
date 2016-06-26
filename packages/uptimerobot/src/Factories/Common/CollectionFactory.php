<?php
/**
 * ArrayFactory.php, dashboard
 *
 * This File belongs to to Project dashboard
 *
 * @author Oliver Kaufmann <okaufmann91@gmail.com>
 * @version 1.0
 * @package YOUREOACKAGE
 */

namespace Okaufmann\UptimeRobot\Factories\Common;

abstract class CollectionFactory extends ArrayFactory
{
    public function create($data = null, $type)
    {
        $array = parent::create($data, $type);

        return collect($array);
    }
}