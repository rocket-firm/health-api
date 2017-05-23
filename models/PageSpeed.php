<?php

namespace app\models;

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
     * @return PagespeedQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PagespeedQuery(get_called_class());
    }
}
