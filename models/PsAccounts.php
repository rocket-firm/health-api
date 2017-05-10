<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ps_accounts".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $updated_at
 * @property string $created_at
 *
 * @property PsProducts[] $psProducts
 */
class PsAccounts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ps_accounts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['updated_at', 'created_at'], 'safe'],
            [['username', 'password'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPsProducts()
    {
        return $this->hasMany(PsProducts::className(), ['account_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return PsAccountsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PsAccountsQuery(get_called_class());
    }

    /**
     * @param $apiData
     * @return PsProducts
     */
    public function addProduct($apiData)
    {
        $product = PsProducts::findOne(['product_id' => $apiData['id']]);

        if (empty($product)) {
            $product = new PsProducts([
                'account_id' => $this->id
            ]);
        }

        return $product->setApiData($apiData);
    }
}
