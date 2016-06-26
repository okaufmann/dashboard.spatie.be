<?php
/**
 * DateTimeFactory.php, dashboard
 *
 * This File belongs to to Project dashboard
 *
 * @author Oliver Kaufmann <okaufmann91@gmail.com>
 * @version 1.0
 * @package YOUREOACKAGE
 */

namespace Okaufmann\UptimeRobot\Factories\Common;


use Carbon\Carbon;
use Log;
use Okaufmann\UptimeRobot\Factories\AbstractFactory;

class DateTimeFactory extends AbstractFactory
{
    private $inputFormat = "m/d/Y H:i:s";

    public function create($data = null, $type)
    {
        if (empty($data)) {
            return null;
        }

        // woraround for only dates like "06/26/2016"
        if(strlen($data) == 10){
            Log::warning(sprintf("Changed input for consistency. Input was %s", $data));
            $data .= " 00:00:00";
        }

        try {
            return Carbon::createFromFormat($this->inputFormat, $data);
        } catch (\Exception $ex) {
            Log::error(sprintf("Error parsing date from %s", $data));
        }
    }
}