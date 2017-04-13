<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project_availability".
 *
 * @property int $id
 * @property int $responseCode
 * @property int $status
 * @property string $createdAt
 * @property int $projectId
 *
 * @property Project $project
 */
class ProjectAvailability extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_availability';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['responseCode', 'status', 'projectId'], 'required'],
            [['responseCode', 'status', 'projectId'], 'integer'],
            [['createdAt'], 'safe'],
            [['projectId'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['projectId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'responseCode' => 'Response Code',
            'status' => 'Status',
            'createdAt' => 'Created At',
            'projectId' => 'Project ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'projectId']);
    }

    /**
     * @inheritdoc
     * @return ProjectAvailabilityQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjectAvailabilityQuery(get_called_class());
    }
}
