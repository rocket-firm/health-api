<?php

namespace app\models;

use app\components\PageSpeedHelper;
use Yii;

/**
 * This is the model class for table "pagespeed".
 *
 * @property int $id
 * @property int $project_id
 * @property int $desktop
 * @property int $mobile
 * @property int $usability
 * @property string $created_at
 * @property Project $project
 */
class PageSpeed extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pagespeed';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'desktop', 'mobile', 'usability'], 'required'],
            [['project_id', 'desktop', 'mobile', 'usability'], 'integer'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_id' => 'Project ID',
            'desktop' => 'Desktop',
            'mobile' => 'Mobile',
            'usability' => 'Usability',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @inheritdoc
     * @return PageSpeedQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PageSpeedQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }

    /**
     * Saves PageSpeed scores to DB
     *
     * @param Project $project
     * @param $apiKey
     * @return bool
     */
    public static function registerProject(Project $project, $apiKey)
    {
        $object = new self(['project_id' => $project->id]);

        $helperDesktop = new PageSpeedHelper($project->url, $apiKey);
        $helperMobile = new PageSpeedHelper($project->url, $apiKey, PageSpeedHelper::STRATEGY_MOBILE);

        try {
            $desktopData = $helperDesktop->getApiData();
            $mobileData = $helperMobile->getApiData();
        } catch (\Exception $e) {
            return false;
        }

        $object->desktop = $desktopData->ruleGroups->SPEED->score;
        $object->mobile = $mobileData->ruleGroups->SPEED->score;
        $object->usability = $mobileData->ruleGroups->USABILITY->score;

        return $object->save();
    }

    /**
     * @inheritdoc
     */
    public function fields()
    {
        return [
            'desktop',
            'mobile',
            'usability',
            'createdAt' => 'created_at'
        ];
    }
}
