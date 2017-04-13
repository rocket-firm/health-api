<?php
/**
 * Created by PhpStorm.
 * User: naffiq
 * Date: 4/13/2017
 * Time: 11:19 PM
 */

namespace app\modules\apiV1\models;

use app\models\Project as BaseProject;
use yii\helpers\ArrayHelper;

class Project extends BaseProject
{
    /**
     * @inheritdoc
     */
    public function fields()
    {
        return ArrayHelper::merge(parent::fields(), [
            'availability' => 'latestAvailability'
        ]);
    }
}