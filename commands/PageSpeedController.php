<?php
/**
 * Created by PhpStorm.
 * User: naffiq
 * Date: 5/23/2017
 * Time: 11:39 PM
 */

namespace app\commands;


use app\components\PageSpeedHelper;
use app\models\PageSpeed;
use app\models\Project;
use yii\console\Controller;
use yii\helpers\Console;

class PageSpeedController extends Controller
{
    /**
     * Get through all projects and save its' page speed scores for desktop, mobile and usability
     */
    public function actionIndex()
    {
        if (empty(\Yii::$app->params['pageSpeedApiKey'])) {
            Console::output(
                Console::renderColoredString(
                    '%rPageSpeed API key was not found!' .
                    ' It should be included to Yii::$app->params["pageSpeedApiKey"]!%n')
            );
        }
        $apiKey = \Yii::$app->params['pageSpeedApiKey'];
        $projects = Project::find()->active()->all();

        foreach ($projects as $project) {
            PageSpeed::registerProject($project, $apiKey);
        }
    }

    public function actionTest($url = 'https://rocketfirm.com')
    {
        $helper = new PageSpeedHelper($url, $this->getApiKey());

        var_dump($helper->getApiData()->ruleGroups);
    }

    protected function getApiKey()
    {
        if (empty(\Yii::$app->params['pageSpeedApiKey'])) {
            Console::output(
                Console::renderColoredString(
                    '%rPageSpeed API key was not found!' .
                    ' It should be included to Yii::$app->params["pageSpeedApiKey"]!%n')
            );
        }
        return \Yii::$app->params['pageSpeedApiKey'];
    }
}