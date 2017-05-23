<?php
/**
 * Created by PhpStorm.
 * User: naffiq
 * Date: 5/23/2017
 * Time: 11:42 PM
 */

namespace app\components;


use Curl\Curl;

class PageSpeedHelper
{
    const STRATEGY_DESKTOP = 'desktop';
    const STRATEGY_MOBILE = 'mobile';

    const PAGESPEED_BASE_URL = 'https://www.googleapis.com/pagespeedonline/v2/runPagespeed';

    /**
     * @var string Website URL
     */
    protected $url;

    /**
     * @var string Google PageSpeed API key
     */
    protected $apiKey;

    /**
     * @var string Strategy to check
     */
    protected $strategy;

    /**
     * PageSpeedHelper constructor.
     *
     * @param $url
     * @param $apiKey
     * @param string $strategy
     */
    public function __construct($url, $apiKey, $strategy = self::STRATEGY_DESKTOP)
    {
        $this->url = rawurlencode($url);

        $this->apiKey = $apiKey;
        if (empty($this->apiKey)) {
            throw new \InvalidArgumentException('You have to define API Key');
        }

        $this->strategy = strtolower($strategy);
        if (!in_array($this->strategy, [self::STRATEGY_DESKTOP, self::STRATEGY_MOBILE])) {
            throw new \InvalidArgumentException("Strategy {$strategy} is not allowed!" .
                " Allowed parameters are 'mobile' and 'desktop' only!");
        }
    }

    /**
     * Returns PageSpeed request URL
     *
     * @return string
     */
    public function getPageSpeedUrl()
    {
        return static::PAGESPEED_BASE_URL . '?'
            . "url={$this->url}"
            . "&strategy={$this->strategy}&key={$this->apiKey}";
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getApiData()
    {
        $url = $this->getPageSpeedUrl();
        $curl = new Curl();
        $curl->get($url);

        if ($curl->error) {
            throw new \Exception("Error getting PageSpeed data, check your API key");
        }

        return $curl->response;
    }
}