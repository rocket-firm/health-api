<?php
/**
 * Created by PhpStorm.
 * User: naffiq
 * Date: 4/14/2017
 * Time: 12:40 AM
 */

namespace app\modules\apiV1\controllers;


use app\controllers\BaseController;
use app\modules\apiV1\models\Project;
use yii\web\NotFoundHttpException;

class ProjectAvailabilityController extends BaseController
{
    public function actionCreate($projectId)
    {
        $project = $this->findProject($projectId);

        return $project->testAvailability();
    }

    /**
     * Finds required project
     *
     * @param $id
     * @return Project
     * @throws NotFoundHttpException
     */
    private function findProject($id)
    {
        $project = Project::findOne($id);
        if (!$project) {
            throw new NotFoundHttpException('Project was not found');
        }

        return $project;
    }
}