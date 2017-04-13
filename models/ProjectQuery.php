<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Project]].
 *
 * @see Project
 */
class ProjectQuery extends \yii\db\ActiveQuery
{
    /**
     * @return ProjectQuery
     */
    public function active()
    {
        return $this->andWhere(['<>', 'status', Project::STATUS_DISABLED]);
    }

    /**
     * @return ProjectQuery
     */
    public function warningOrCritical()
    {
        return $this->andWhere(['in', 'status', [Project::STATUS_WARNING, Project::STATUS_CRITICAL]]);
    }

    /**
     * @return ProjectQuery
     */
    public function critical()
    {
        return $this->andWhere(['status' => Project::STATUS_CRITICAL]);
    }

    /**
     * @return ProjectQuery
     */
    public function disabled()
    {
        return $this->andWhere(['status' => Project::STATUS_DISABLED]);
    }

    /**
     * @inheritdoc
     * @return Project[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Project|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
