<?php
/**
 * Created by PhpStorm.
 * User: naffiq
 * Date: 4/13/2017
 * Time: 10:37 PM
 */

namespace app\modules\apiV1\controllers;

use app\controllers\BaseController;
use app\models\Project;
use app\modules\apiV1\models\ProjectSearch;

class ProjectController extends BaseController
{
    public function actionIndex()
    {
        $search = new ProjectSearch();
        return $search->search();
    }

    public function actionCreate()
    {
        $model = new Project(['status' => Project::STATUS_UNCHECKED]);

        $model->load(\Yii::$app->request->post(), '');

        if ($model->save()) {
            return ['success' => true, 'id' => $model];
        }

        return ['success' => false, 'errors' => $model->getErrors()];
    }
}