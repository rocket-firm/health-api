<?php
/**
 * Created by PhpStorm.
 * User: naffiq
 * Date: 4/14/2017
 * Time: 12:09 AM
 */

namespace app\components;

/**
 * Class AvailabilityTester
 *
 * @package app\components
 */
class AvailabilityTester
{
    /**
     * @var string URL to get
     */
    protected $url;

    /**
     * @var integer Response code
     */
    public $responseCode;

    /**
     * @var float URL get time
     */
    public $execTime;

    /**
     * ProjectAvailabilityTester constructor.
     * @param string $url
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * @return $this
     */
    public function test()
    {
        $this->execChannel();

        return $this;
    }

    /**
     * @return mixed
     */
    protected function execChannel()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_HEADER, 1);

        $startTime = microtime(true);
        $response = curl_exec($ch);
        $this->execTime = microtime(true) - $startTime;

        $this->responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);;

        curl_close($ch);
        return $response;
    }
}