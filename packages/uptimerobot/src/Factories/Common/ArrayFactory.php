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


use Okaufmann\UptimeRobot\Factories\AbstractFactory;

abstract class ArrayFactory extends AbstractFactory
{
    abstract function getItemFactory();

    public function create($data = null, $type)
    {
        if ($data == null || count($data) == 0) {
            return [];
        }

        $list = [];
        foreach ($data as $entry) {
            $list[] = $this->getItemFactory($entry, $type)->create($entry, $type);
        }

        return $list;
    }
}