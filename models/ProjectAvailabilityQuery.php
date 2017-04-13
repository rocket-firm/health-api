<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ProjectAvailability]].
 *
 * @see ProjectAvailability
 */
class ProjectAvailabilityQuery extends \yii\db\ActiveQuery
{
    /**
     * Get latest availability test
     *
     * @param Project $project
     * @return ProjectAvailabilityQuery
     */
    public function latestByProject(Project $project)
    {
        $this->primaryModel = $project;
        $this->link = ['id' => 'projectId'];
        $this->multiple = false;
        return $this->latest();
    }

    /**
     * Get all availability tests in chronological order
     *
     * @param Project $project
     * @return ProjectAvailabilityQuery
     */
    public function byProject(Project $project)
    {
        $query = $this->latestByProject($project);
        $query->multiple = true;
        return $query;
    }

    /**
     * @return $this
     */
    public function latest() {
        return $this->orderBy(['createdAt' => SORT_DESC]);
    }

    /**
     * @inheritdoc
     * @return ProjectAvailability[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ProjectAvailability|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
