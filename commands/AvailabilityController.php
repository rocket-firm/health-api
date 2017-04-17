<?php
/**
 * Created by PhpStorm.
 * User: naffiq
 * Date: 4/17/2017
 * Time: 9:07 PM
 */

namespace app\commands;


use app\models\Project;
use yii\console\Controller;

/**
 * Class AvailabilityController
 *
 * Checking projects' main page for availability
 *
 * @package app\commands
 */
class AvailabilityController extends Controller
{
    /**
     * Tests all active projects' availability
     */
    public function actionIndex()
    {
        $projects = Project::find()->active()->all();

        foreach ($projects as $project) {
            $project->testAvailability();
        }
    }
}