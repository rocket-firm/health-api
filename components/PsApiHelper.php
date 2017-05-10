<?php
/**
 * Created by PhpStorm.
 * User: naffiq
 * Date: 5/10/2017
 * Time: 7:16 AM
 */

namespace app\components;


use app\models\PsAccounts;
use Curl\Curl;

class PsApiHelper
{
    /**
     * @var PsAccounts
     */
    private $account;

    public function __construct(PsAccounts $account)
    {
        $this->account = $account;
    }

    public function getApiData()
    {
        $url = $this->account->getApiUrl();
        $curl = new Curl();
        $curl->get($url);

        if ($curl->error) {
            throw new \Exception("Error getting PS account data");
        }

        return $curl->response;
    }
}