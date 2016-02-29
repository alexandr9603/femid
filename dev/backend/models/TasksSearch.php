<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Tasks;

/**
 * TasksSearch represents the model behind the search form about `backend\models\Tasks`.
 */
class TasksSearch extends Tasks
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['task_id', 'user_id', 'category_id', 'urist_id', 'stat', 'form'], 'integer'],
            [['txt', 'date_add', 'date_upd', 'name'], 'safe'],
            [['price'], 'number'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Tasks::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'task_id' => $this->task_id,
            'user_id' => $this->user_id,
            'category_id' => $this->category_id,
            'urist_id' => $this->urist_id,
            'date_add' => $this->date_add,
            'date_upd' => $this->date_upd,
            'price' => $this->price,
            'stat' => $this->stat,
            'form' => $this->form,
        ]);

        $query->andFilterWhere(['like', 'txt', $this->txt])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
