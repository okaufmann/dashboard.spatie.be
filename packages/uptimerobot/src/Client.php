<?php
/**
 * This project is an open source implementation for acessing the UptimeRobot api.
 * Full documentation: http://uptimerobot.com/api
 *
 * @version     1.0
 * @author      Watchful, Oliver Kaufmann
 * @authorUrl   http://www.watchful.li
 * @filesource  From mb2o <https://github.com/CodingOurWeb/PHP-wrapper-for-UptimeRobot-API>
 * @license     GNU General Public License version 2 or later
 */

namespace Okaufmann\UptimeRobot;

use GuzzleHttp\TransferStats;
use Illuminate\Config\Repository;
use Illuminate\Support\Collection;
use Log;
use Okaufmann\UptimeRobot\Exceptions\ArgumentNullException;
use Okaufmann\UptimeRobot\Exceptions\NotSupportedException;
use Okaufmann\UptimeRobot\Factories\MonitorCollectionFactory;
use Okaufmann\UptimeRobot\Models\Collections\ResultCollection;
use Okaufmann\UptimeRobot\Models\Queries\MonitorsQuery;

class Client
{
    private $base_uri = 'https://api.uptimerobot.com';
    private $apiKey;
    private $allowJsonCallback;
    private $format = "json";
    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * Build Client
     *
     * @param Repository         $config
     * @param \GuzzleHttp\Client $client
     */
    public function __construct(Repository $config)
    {
        // no json callback --> allow : false
        $this->apiKey = $config->get('uptimerobot.key');
        $this->allowJsonCallback = $config->get('uptimerobot.allow-json-callback');
        $this->format = $config->get('uptimerobot.format');
        $this->client = new \GuzzleHttp\Client([
            'base_uri' => $this->base_uri
        ]);
    }

    /**
     * Returns the API key
     *
     */
    public function getApiKey()
    {
        if (empty($this->apiKey)) {
            throw new ArgumentNullException('apiKey');
        }

        return $this->apiKey;
    }

    /**
     * Gets output format of API calls
     *
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Sets output format of API calls xml / json
     *
     * @param mixed $format required
     *
     */
    public function setFormat($format)
    {
        if (empty($format)) {
            throw new ArgumentNullException('format');
        }

        if (($format != 'xml' && $format != 'json')) {
            throw new NotSupportedException('format');
        }

        $this->format = $format;
    }

    /**
     * Returns the result of the API calls
     *
     * @param string $url required
     * @param array  $queryParams
     * @param bool   $json
     * @return bool|array
     * @throws \Exception
     */
    private function __fetch($url, $queryParams = [], $json = true)
    {
        if (empty($url)) {
            throw new ArgumentNullException('url');
        }

        $queryParams['apiKey'] = $this->getApiKey();

        $queryParams['format'] = $this->format;
        $queryParams['noJsonCallback'] = $this->allowJsonCallback ? 0 : 1;

        $response = $this->client->get(trim($url, '/'), [
            'query' => $queryParams,
            'on_stats' => function (TransferStats $stats) use (&$url) {
                $url = $stats->getEffectiveUri();
            }
        ]);

        Log::debug('Fetched data from url: ' . $url);

        $responseBody = (string) $response->getBody();

        if ($this->format == 'xml') {
            return $responseBody;
        } else {
            if (! $this->allowJsonCallback) {
                return $json ? json_decode($responseBody, true) : $responseBody;
            } else {
                return $responseBody;
            }
        }

        return false;
    }

    /**
     * This is a Swiss-Army knife type of a method for getting any information on monitors
     *
     * @param array|int $monitors optional    if not used, will return all monitors in an account. Else, it is possible to define any number of monitors with their IDs
     * @param int       $customUpTimeRatio optional    Defines the number of days to calculate the uptime ratio(s)
     * @param bool      $logs optional    Defines if the logs of each monitor will be returned
     * @param bool      $responseTimes optional    Defines if the response time data of each monitor will be returned
     * @param bool      $responseTimesAverage optional    By default, response time value of each check is returned. The API can return average values in given minutes. Default is 0
     * @param bool      $alertContacts optional    Defines if the notified alert contacts of each notification will be returned.
     *                                                      Requires logs to be set to 1
     * @param bool      $showMonitorAlertContacts optional    Defines if the alert contacts set for the monitor to be returned
     * @param bool      $showTimezone optional    Defines if the user's timezone should be returned
     * @param string    $search optional    a keyword of your choice to search within monitorURL and monitorFriendlyName and get filtered results
     *
     * @return ResultCollection
     */
    public function getMonitors(MonitorsQuery $query)
    {
        $queryParams = [
            'monitors'                 => $this->getImplode($query->monitors),
            'types'                    => $this->getImplode($query->types),
            'statuses'                 => $this->getImplode($query->statuses),
            'customUptimeRatio'        => $this->getImplode($query->customUptimeRatio),
            'logs'                     => $query->logs,
            'logsLimit'                => $query->logsLimit,
            'responseTimes'            => $query->responseTimes,
            'responseTimesLimit'       => $query->responseTimesLimit,
            'responseTimesAverage'     => $query->responseTimesAverage,
            'responseTimesStartDate'   => $query->responseTimesStartDate,
            'responseTimesEndDate'     => $query->responseTimesEndDate,
            'alertContacts'            => $query->alertContacts,
            'showMonitorAlertContacts' => $query->showMonitorAlertContacts,
            'showTimezone'             => $query->showTimezone,
            'offset'                   => $query->offset,
            'limit'                    => $query->limit,
            'search'                   => $query->search ? htmlspecialchars($query->search) : null,

        ];

        $result = $this->__fetch('getMonitors', $queryParams);

        $monitors = $this->getFactory()->create($result,
            \Okaufmann\UptimeRobot\Models\Collections\ResultCollection::class);

        // fetch all pages at once are not performant!
        //while (($limit * $offset) + $limit < $total) {
        //    $result->limit = ($limit * $offset) + $limit;
        //    $offset++;
        //    $append = $this->__fetch($url.'&offset='.($offset*$limit));
        //    $result->monitors->monitor = array_merge($result->monitors->monitor, $append->monitors->monitor);
        //}
        //$result->limit = ($limit * $offset) + $limit;

        return $monitors;
    }

    /**
     * New monitors of any type can be created using this method
     *
     * @param string    $friendlyName required
     * @param string    $URL required
     * @param int       $type required
     * @param int       $subType optional (required for port monitoring)
     * @param int       $port optional (required for port monitoring)
     * @param int       $keywordType optional (required for keyword monitoring)
     * @param string    $keywordValue optional (required for keyword monitoring)
     * @param string    $HTTPUsername optional
     * @param string    $HTTPPassword optional
     * @param string    $monitorInterval optional interval in min
     * @param array|int $alertContacts optional The alert contacts to be notified Multiple alertContactIDs can be sent
     */
    public function newMonitor(
        $friendlyName,
        $URL,
        $type,
        $subType = null,
        $port = null,
        $keywordType = null,
        $keywordValue = null,
        $HTTPUsername = null,
        $HTTPPassword = null,
        $alertContacts = null,
        $monitorInterval = 5
    ) {
        if (empty($friendlyName) || empty($URL) || empty($type)) {
            throw new \Exception('Required key "name", "uri" or "type" not specified', 3);
        }

        $friendlyName = urlencode($friendlyName);

        //$url = $this->base_uri . '/newMonitor?monitorFriendlyName=' . $friendlyName . '&monitorURL=' . $URL . '&monitorType=' . $type;
        //
        //if (! empty($subType)) {
        //    $url .= '&monitorSubType=' . $subType;
        //}
        //if (! empty($port)) {
        //    $url .= '&monitorPort=' . $port;
        //}
        //if (isset($keywordType)) {
        //    $url .= '&monitorKeywordType=' . $keywordType;
        //}
        //if (isset($keywordValue)) {
        //    $url .= '&monitorKeywordValue=' . urlencode($keywordValue);
        //}
        //if (isset($HTTPUsername)) {
        //    $url .= '&monitorHTTPUsername=' . urlencode($HTTPUsername);
        //}
        //if (isset($HTTPPassword)) {
        //    $url .= '&monitorHTTPPassword=' . urlencode($HTTPPassword);
        //}
        //if (! empty($alertContacts)) {
        //    $url .= '&monitorAlertContacts=' . $this->getImplode($alertContacts);
        //}
        //if (! empty($monitorInterval)) {
        //    $url .= '&monitorInterval=' . $monitorInterval;
        //}

        $queryParams = [
            'monitorFriendlyName'  => $friendlyName,
            'monitorURL'           => $URL,
            'monitorType'          => $type,
            'monitorSubType'       => $subType,
            'monitorPort'          => $port,
            'monitorKeywordType'   => $keywordType,
            'monitorKeywordValue'  => urlencode($keywordValue),
            'monitorHTTPUsername'  => urlencode($HTTPUsername),
            'monitorHTTPPassword'  => urlencode($HTTPPassword),
            'monitorAlertContacts' => $this->getImplode($alertContacts),
            'monitorInterval'      => $monitorInterval
        ];

        return $this->__fetch('newMonitor', $queryParams);
    }

    /**
     * Monitors can be edited using this method.
     *
     * Important: The type of a monitor can not be edited (like changing a HTTP monitor into a Port monitor).
     * For such cases, deleting the monitor and re-creating a new one is adviced.
     *
     * @param int       $monitorId required
     * @param bool      $monitorStatus optional
     * @param string    $friendlyName optional
     * @param string    $URL optional
     * @param int       $subType optional (used only for port monitoring)
     * @param int       $port optional (used only for port monitoring)
     * @param int       $keywordType optional (used only for keyword monitoring)
     * @param string    $keywordValue optional (used only for keyword monitoring)
     * @param string    $HTTPUsername optional (in order to remove any previously added username, simply send the value empty)
     * @param string    $HTTPPassword optional (in order to remove any previously added password, simply send the value empty)
     * @param array|int $alertContacts optional   The alert contacts to be notified Multiple alertContactIDs can be sent
     *                                              (in order to remove any previously added alert contacts, simply send the value empty like '')
     */
    public function editMonitor(
        $monitorId,
        $monitorStatus = null,
        $friendlyName = null,
        $URL = null,
        $subType = null,
        $port = null,
        $keywordType = null,
        $keywordValue = null,
        $HTTPUsername = null,
        $HTTPPassword = null,
        $alertContacts = null
    ) {

        //$url = $this->base_uri . '/editMonitor?monitorID=' . $monitorId;
        //
        //if (isset($monitorStatus)) {
        //    $url .= '&monitorStatus=' . $monitorStatus;
        //}
        //if (isset($friendlyName)) {
        //    $url .= '&monitorFriendlyName=' . urlencode($friendlyName);
        //}
        //if (isset($URL)) {
        //    $url .= '&monitorURL=' . $URL;
        //}
        //if (isset($subType)) {
        //    $url .= '&monitorSubType=' . $subType;
        //}
        //if (isset($port)) {
        //    $url .= '&monitorPort=' . $port;
        //}
        //if (isset($keywordType)) {
        //    $url .= '&monitorKeywordType=' . $keywordType;
        //}
        //if (isset($keywordValue)) {
        //    $url .= '&monitorKeywordValue=' . urlencode($keywordValue);
        //}
        //if (isset($HTTPUsername)) {
        //    $url .= '&monitorHTTPUsername=' . urlencode($HTTPUsername);
        //}
        //if (isset($HTTPPassword)) {
        //    $url .= '&monitorHTTPPassword=' . urlencode($HTTPPassword);
        //}
        //if (! empty($alertContacts)) {
        //    $url .= '&monitorAlertContacts=' . $this->getImplode($alertContacts);
        //}

        $queryParams = [
            'monitorID'            => $monitorId,
            'monitorStatus'        => $monitorStatus,
            'monitorFriendlyName'  => urlencode($friendlyName),
            'monitorURL'           => $URL,
            'monitorSubType'       => $subType,
            'monitorPort'          => $port,
            'monitorKeywordType'   => $keywordType,
            'monitorKeywordValue'  => urlencode($keywordValue),
            'monitorHTTPUsername'  => urlencode($HTTPUsername),
            'monitorHTTPPassword'  => urlencode($HTTPPassword),
            'monitorAlertContacts' => $this->getImplode($alertContacts),
        ];

        return $this->__fetch('editMonitor', $queryParams);
    }

    /**
     * Monitors can be deleted using this method.
     *
     * @param int $monitorId required
     */
    public function deleteMonitor($monitorId)
    {
        if (empty($monitorId)) {
            throw new ArgumentNullException('monitorId');
        }

        //$url = $this->base_uri . '/deleteMonitor?monitorID=' . $monitorId;

        return $this->__fetch('deleteMonitor', ['monitorID' => $monitorId]);
    }

    /**
     * The list of alert contacts can be called with this method.
     *
     * @param array|int $alertcontacts optional    if not used, will return all alert contacts in an account.
     *                                              Else, it is possible to define any number of alert contacts with their IDs
     */
    public function getAlertContacts($alertcontacts = null)
    {
        //$url = $this->base_uri . '/getAlertContacts';
        //
        //if (! empty($alertcontacts)) {
        //    $url .= '?alertcontacts=' . $this->getImplode($alertcontacts);
        //}

        return $this->__fetch('getAlertContacts', ['alertcontacts' => $this->getImplode($alertcontacts)]);
    }

    /**
     * New alert contacts of any type (mobile/SMS alert contacts are not supported yet) can be created using this method.
     *
     * @param int    $alertContactType required
     * @param string $alertContactValue required
     */
    public function newAlertContact($alertContactType, $alertContactValue)
    {
        if (empty($alertContactType) || empty($alertContactValue)) {
            throw new ArgumentNullException(['alertContactValue', 'alertContactValue']);
        }

        $alertContactValue = urlencode($alertContactValue);

        //$url = $this->base_uri . '/newAlertContact?alertContactType=' . $alertContactType . '&alertContactValue=' . $alertContactValue;

        $queryParams = [
            'newAlertContact'   => $alertContactType,
            'alertContactValue' => $alertContactValue
        ];

        return $this->__fetch('newAlertContact', $queryParams);
    }

    /**
     * Alert contacts can be deleted using this method.
     *
     * @param int $alertContactID required
     */
    public function deleteAlertContact($alertContactID)
    {
        if (empty($alertContactID)) {
            throw new ArgumentNullException('alertContactID'
            );
        }

        // $url = $this->base_uri . '/deleteAlertContact?alertContactID=' . $alertContactID;

        return $this->__fetch('deleteAlertContact', ['alertContactID' => $alertContactID]);
    }

    /**
     * Array or int to string with separator (-)
     *
     * @param array|int $var
     * @return type string
     */
    private function getImplode($var)
    {
        if (is_array($var)) {
            return implode('-', $var);
        }

        return $var;
    }

    /**
     * @return MonitorCollectionFactory
     */
    public function getFactory()
    {
        return new MonitorCollectionFactory();
    }

}