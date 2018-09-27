<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Project;

/**
 * ProjectSearch represents the model behind the search form of `common\models\Project`.
 */
class ProjectSearch extends Project
{
    public $created_at_range;
    public $updated_at_range;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'active', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['title', 'description', 'created_at_range', 'updated_at_range'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Project::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        /* created_at_range */
        if(!empty($this->created_at_range) && strpos($this->created_at_range, '-') !== false) {
            list($start_date, $end_date) = explode(' - ', $this->created_at_range);
            $query->andFilterWhere(['between', 'project.created_at', strtotime($start_date), strtotime($end_date)]);
        }
        /* updated_at_range */
        if(!empty($this->updated_at_range) && strpos($this->updated_at_range, '-') !== false) {
            list($start_date, $end_date) = explode(' - ', $this->updated_at_range);
            $query->andFilterWhere(['between', 'project.updated_at', strtotime($start_date), strtotime($end_date)]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'active' => $this->active,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
