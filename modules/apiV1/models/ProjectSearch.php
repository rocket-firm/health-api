<?php
/**
 * Created by PhpStorm.
 * User: naffiq
 * Date: 4/13/2017
 * Time: 11:20 PM
 */

namespace app\modules\apiV1\models;


use yii\data\ActiveDataProvider;

class ProjectSearch extends Project
{
    public function search($data = [])
    {
        $this->load($data);

        $query = self::find();

        return new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'status' => SORT_DESC,
                    'createdAt' => SORT_DESC
                ]
            ]
        ]);
    }
}