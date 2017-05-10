<?php
/**
 * Created by PhpStorm.
 * User: naffiq
 * Date: 5/10/2017
 * Time: 8:38 AM
 */

namespace app\commands;

use app\models\PsAccounts;
use yii\console\Controller;

class PsAccountController extends Controller
{
    public function actionGetProducts()
    {
        $accounts = PsAccounts::find()->all();

        foreach ($accounts as $account) {
            $account->getApiData();
        }
    }
}