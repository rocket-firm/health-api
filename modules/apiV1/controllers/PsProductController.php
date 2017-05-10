<?php
/**
 * Created by PhpStorm.
 * User: naffiq
 * Date: 5/10/2017
 * Time: 7:33 AM
 */

namespace app\modules\apiV1\controllers;

use yii\rest\ActiveController;

class PsAccountController extends ActiveController
{
    public $modelClass = '\app\models\PsProducts';

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return array_merge(parent::behaviors(), [

            // For cross-domain AJAX request
            'corsFilter'  => [
                'class' => \yii\filters\Cors::className(),
                'cors'  => [
                    // restrict access to domains:
                    'Origin'                           => ['*'],
                    'Access-Control-Request-Method'    => ['POST'],
                    'Access-Control-Allow-Credentials' => true,
                    'Access-Control-Max-Age'           => 3600,                 // Cache (seconds)
                ],
            ],

        ]);
    }
}