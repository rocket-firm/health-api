<?php

namespace app\models;

use app\components\AvailabilityTester;
use Yii;
use yii\db\Exception;

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
 * @property PageSpeed[] $pageSpeed
 * @property PageSpeed $latestPageSpeed
 */
class Project extends \yii\db\ActiveRecord
{
    const STATUS_DISABLED = 0;
    const STATUS_HEALTHY = 10;
    const STATUS_WARNING = 20;
    const STATUS_CRITICAL = 30;
    const STATUS_UNCHECKED = 40;

    public function init()
    {
        parent::init();
        $this->status = self::STATUS_UNCHECKED;
    }

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

    /**
     * @return PageSpeedQuery
     */
    public function getLatestPageSpeed()
    {
        return PageSpeed::find()->latestByProject($this);
    }

    /**
     * @return PageSpeedQuery
     */
    public function getPageSpeed()
    {
        return PageSpeed::find()->byProject($this);
    }

    /**
     * @return ProjectAvailability
     * @throws Exception
     */
    public function testAvailability()
    {
        $tester = (new AvailabilityTester($this->url))->test();

        if ($this->status !== self::getStatusByResponseCode($tester->responseCode)) {
            $this->status = self::getStatusByResponseCode($tester->responseCode);
            $this->save(true, ['status']);
        }

        $availabilityReport = new ProjectAvailability([
            'projectId' => $this->id,
            'status' => self::getStatusByResponseCode($tester->responseCode),
            'responseCode' => $tester->responseCode
        ]);

        if ($availabilityReport->save()) {
            return $availabilityReport;
        }

        throw new Exception('Error saving availability report: '
            . json_encode($availabilityReport->getErrors()));
    }

    /**
     * Checks responseCode and returns project status
     *
     * @param int $responseCode
     * @return int
     */
    public static function getStatusByResponseCode($responseCode)
    {
        if ($responseCode === 200) {
            return self::STATUS_HEALTHY;
        } elseif ($responseCode >= 300 && $responseCode < 400) {
            return self::STATUS_WARNING;
        }

        return self::STATUS_CRITICAL;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        $this->testAvailability();
    }
}
