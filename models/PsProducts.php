<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ps_products".
 *
 * @property int $id
 * @property int $product_id
 * @property string $domain
 * @property int $diskusage
 * @property int $disklimit
 * @property string $description
 * @property string $updated_at
 * @property string $created_at
 * @property int $account_id
 *
 * @property PsAccounts $account
 */
class PsProducts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ps_products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'domain', 'description', 'account_id'], 'required'],
            [['product_id', 'diskusage', 'disklimit', 'account_id'], 'integer'],
            [['updated_at', 'created_at'], 'safe'],
            [['domain', 'description'], 'string', 'max' => 255],
            [['account_id'], 'exist', 'skipOnError' => true, 'targetClass' => PsAccounts::className(), 'targetAttribute' => ['account_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'domain' => 'Domain',
            'diskusage' => 'Diskusage',
            'disklimit' => 'Disklimit',
            'description' => 'Description',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
            'account_id' => 'Account ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(PsAccounts::className(), ['id' => 'account_id']);
    }

    /**
     * @inheritdoc
     * @return PsProductsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PsProductsQuery(get_called_class());
    }

    /**
     * @param $apiData
     * @return PsProducts
     */
    public function setApiData($apiData)
    {
        $this->product_id = $apiData['id'];
        $this->domain = $apiData['domain'];
        $this->description = $apiData['description'];
        $this->diskusage = $apiData['options']['diskusage'];
        $this->disklimit = $apiData['options']['disklimit'];

        return $this;
    }
}
