<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[PsAccounts]].
 *
 * @see PsAccounts
 */
class PsAccountsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return PsAccounts[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return PsAccounts|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
