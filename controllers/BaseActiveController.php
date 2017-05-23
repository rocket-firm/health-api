<?php
/**
 * Created by PhpStorm.
 * User: naffiq
 * Date: 5/10/17
 * Time: 3:47 PM
 */

namespace app\controllers;


use yii\filters\ContentNegotiator;
use yii\filters\Cors;
use yii\rest\ActiveController;
use yii\web\Response;

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

            'contentNegotiator' => [
                'class' => ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],

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