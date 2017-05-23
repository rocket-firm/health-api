<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[PageSpeed]].
 *
 * @see PageSpeed
 */
class PageSpeedQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return PageSpeed[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return PageSpeed|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return PageSpeedQuery
     */
    public function latest()
    {
        return $this->addOrderBy(['pagespeed.created_at' => SORT_DESC]);
    }

    /**
     * Get latest page speed test
     *
     * @param Project $project
     * @return PageSpeedQuery
     */
    public function latestByProject(Project $project)
    {
        $this->primaryModel = $project;
        $this->link = ['project_id' => 'id'];
        $this->multiple = false;
        return $this->latest();
    }

    /**
     * Get all page speed tests in chronological order
     *
     * @param Project $project
     * @return PageSpeedQuery
     */
    public function byProject(Project $project)
    {
        $query = $this->latestByProject($project);
        $query->multiple = true;
        return $query;
    }
}
