<?php
/**
 * Created by PhpStorm.
 * User: naffiq
 * Date: 4/13/2017
 * Time: 10:37 PM
 */

namespace app\modules\apiV1\controllers;

use app\controllers\BaseActiveController;

/**
 * Class ProjectController
 *
 * @package app\modules\apiV1\controllers
 */
class ProjectController extends BaseActiveController
{
    public $modelClass = '\app\modules\apiV1\models\Project';
}