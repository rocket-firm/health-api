<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[PsProducts]].
 *
 * @see PsProducts
 */
class PsProductsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return PsProducts[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return PsProducts|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
