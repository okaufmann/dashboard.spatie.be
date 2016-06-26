<?php

/**
 * AbstractFactory.php, dashboard
 *
 * This File belongs to to Project dashboard
 *
 * @author Oliver Kaufmann <okaufmann91@gmail.com>
 * @version 1.0
 * @package YOUREOACKAGE
 */

namespace Okaufmann\UptimeRobot\Factories;


use Log;

abstract class AbstractFactory
{
    public function create($data = null, $type)
    {
        $obj = new $type();
        if (! $data || count($data) == 0) {
            return $obj;
        }

        foreach ($data as $key => $value) {
            $prop = $key;

            Log::debug(sprintf("Process property: %s", $prop));

            // key data field name from result could be mapped
            if (property_exists($this, 'propertyMappings')) {
                if (isset($this->propertyMappings[$key])) {
                    $prop = $this->propertyMappings[$key];
                    Log::debug(sprintf("property renamed to %s", $prop));
                }
            }

            $prop = camel_case($prop);

            $setter = 'set' . ucfirst($prop);
            Log::debug(sprintf("use setter %s", $setter));

            if (property_exists($type, $prop)) {
                $factory = $this->getPropertyFactory($prop);
                if ($factory != null) {
                    Log::debug(sprintf("got factory settings: %s", $factory['factory']));
                    $value = (new $factory['factory'])->create($value, $factory['type']);
                } else {
                    if (is_numeric($value)) {
                        if (str_contains($value, ".")) {
                            $value = floatval($value);
                        }else{
                            $value = intval($value);
                        }
                    }
                }

                $obj->$setter($value);
            }
        }

        return $obj;
    }

    public function getPropertyFactory($property)
    {
        if (property_exists($this, 'propertyFactories')) {
            if (isset($this->propertyFactories[$property])) {
                Log::debug(sprintf("get factory for %s", $property));
                return $this->propertyFactories[$property];
            }
        }

        return null;
    }
}