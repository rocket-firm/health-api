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
            [['product_id', 'domain', 'description'], 'required'],
            [['product_id', 'diskusage', 'disklimit'], 'integer'],
            [['updated_at', 'created_at'], 'safe'],
            [['domain', 'description'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * @inheritdoc
     * @return PsProductsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PsProductsQuery(get_called_class());
    }
}
