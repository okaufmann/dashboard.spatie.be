<?php

/**
 * ResultCollection.php, dashboard
 *
 * This File belongs to to Project dashboard
 *
 * @author Oliver Kaufmann <okaufmann91@gmail.com>
 * @version 1.0
 * @package YOUREOACKAGE
 */

namespace Okaufmann\UptimeRobot\Models\Collections;

class ResultCollection
{
    /**
     * @var int
     */
    private $limit;

    /**
     * @var int
     */
    private $offset;
    /**
     * @var int
     */
    private $total;

    /**
     * @var \Illuminate\Support\Collection
     */
    private $monitors;

    /**
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
    }

    /**
     * @return int
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @param int $offset
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param int $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getMonitors()
    {
        return $this->monitors;
    }

    /**
     * @param \Illuminate\Support\Collection $monitors
     */
    public function setMonitors($monitors)
    {
        $this->monitors = $monitors;
    }
}