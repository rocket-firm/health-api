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
     * @var int URL get time in seconds
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
        $options = array(
            CURLOPT_URL            => $this->url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_AUTOREFERER    => true,
            CURLOPT_CONNECTTIMEOUT => 120,
            CURLOPT_TIMEOUT        => 120,
            CURLOPT_MAXREDIRS      => 10,
        );
        curl_setopt_array( $ch, $options );

        $response = curl_exec($ch);

        $this->responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $this->execTime = curl_getinfo($ch, CURLINFO_TOTAL_TIME);
        curl_close($ch);

        return $response;
    }
}