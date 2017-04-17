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
use yii\web\NotFoundHttpException;

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
            return ['success' => true, 'project' => $model];
        }

        return ['success' => false, 'errors' => $model->getErrors()];
    }

    public function actionDelete($id)
    {
        $model = Project::findOne($id);

        if (!$model) {
            return false;
        }

        return $model->delete();
    }

    public function actionUpdate($id)
    {
        $model = Project::findOne($id);

        if (!$model) {
            throw new NotFoundHttpException('Project not found');
        }

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return ['success' => true];
        }

        return ['success' => false, 'errors' => $model->getErrors()];
    }
}