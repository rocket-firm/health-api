<?php
/**
 * Created by PhpStorm.
 * User: naffiq
 * Date: 5/10/2017
 * Time: 9:06 AM
 */

namespace app\modules\apiV1\models;


class PsAccounts extends \app\models\PsAccounts
{
    public function fields()
    {
        return [
            'id',
            'username',
            'products' => 'psProducts'
        ];
    }
}