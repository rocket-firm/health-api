<?php
/**
 * Created by PhpStorm.
 * User: naffiq
 * Date: 5/10/17
 * Time: 3:47 PM
 */

namespace app\controllers;


use yii\filters\Cors;
use yii\rest\ActiveController;

/**
 * Class BaseActiveController
 * @package app\controllers
 */
class BaseActiveController extends ActiveController
{

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return array_merge(parent::behaviors(), [

            // For cross-domain AJAX request
            'corsFilter'  => [
                'class' => Cors::className(),
                'cors'  => [
                    // restrict access to domains:
                    'Origin'                           => ['*'],
                    'Access-Control-Request-Method'    => ['POST', 'GET', 'DELETE', 'PUT', 'OPTIONS'],
                    'Access-Control-Allow-Credentials' => true,
                    'Access-Control-Max-Age'           => 60,                 // Cache (seconds)
                ],
            ],

        ]);
    }
}