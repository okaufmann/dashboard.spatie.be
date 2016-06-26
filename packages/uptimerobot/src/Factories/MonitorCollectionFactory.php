<?php

/**
 * MonitorCollectionFactory.php, dashboard
 *
 * This File belongs to to Project dashboard
 *
 * @author Oliver Kaufmann <okaufmann91@gmail.com>
 * @version 1.0
 * @package YOUREOACKAGE
 */

namespace Okaufmann\UptimeRobot\Factories;

use Illuminate\Support\Collection;
use Okaufmann\UptimeRobot\Models\AbstractModel;
use Okaufmann\UptimeRobot\Models\Collections\ResultCollection;

class MonitorCollectionFactory extends AbstractFactory
{
    /**
     * Convert an array with an collection of items to an hydrated object collection
     *
     * @param  array        $data
     * @param AbstractModel $type
     * @return Collection
     */
    public function create($data = null, $type)
    {
        $resultCol = new ResultCollection();

        $resultCol->setLimit($data['limit']);
        $resultCol->setLimit($data['offset']);
        $resultCol->setLimit($data['total']);

        $monitors = $data['monitors']['monitor'];

        $col = [];

        foreach ($monitors as $monitorData) {
            $col[] = $this->getFactory()->create($monitorData, \Okaufmann\UptimeRobot\Models\Monitor::class);
        }

        $resultCol->setMonitors(collect($col));

        return $resultCol;
    }

    private function getFactory()
    {
        return new MonitorFactory();
    }
}