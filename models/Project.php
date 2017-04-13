<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string $title
 * @property string $url
 * @property string $healthUrl
 * @property int $status
 * @property string $createdAt
 * @property string $updatedAt
 */
class Project extends \yii\db\ActiveRecord
{
    const STATUS_DISABLED = 0;
    const STATUS_HEALTHY = 10;
    const STATUS_WARNING = 20;
    const STATUS_CRITICAL = 30;
    const STATUS_UNCHECKED = 40;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'url', 'status'], 'required'],
            [['status'], 'integer'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['title', 'url', 'healthUrl'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'url' => 'Url',
            'healthUrl' => 'Health Url',
            'status' => 'Status',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
        ];
    }

    /**
     * @inheritdoc
     * @return ProjectQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjectQuery(get_called_class());
    }

    /**
     * @return ProjectAvailabilityQuery
     */
    public function getLatestAvailability()
    {
        return ProjectAvailability::find()->latestByProject($this);
    }

    /**
     * @return ProjectAvailabilityQuery
     */
    public function getAvailability()
    {
        return ProjectAvailability::find()->byProject($this);
    }
}
