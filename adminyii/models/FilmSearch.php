<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Film;

/**
 * FilmSearch represents the model behind the search form of `app\models\Film`.
 */
class FilmSearch extends Film
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['film_id', 'premiereWorld', 'premiereRF', 'release_year', 'duration', 'status'], 'integer'],
            [['title', 'description', 'content', 'poster', 'alias'], 'safe'],
            [['budget', 'fees'], 'number'],
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
        $query = Film::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'film_id' => $this->film_id,
            'budget' => $this->budget,
            'fees' => $this->fees,
            'premiereWorld' => $this->premiereWorld,
            'premiereRF' => $this->premiereRF,
            'release_year' => $this->release_year,
            'duration' => $this->duration,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['ilike', 'title', $this->title])
            ->andFilterWhere(['ilike', 'description', $this->description])
            ->andFilterWhere(['ilike', 'content', $this->content])
            ->andFilterWhere(['ilike', 'poster', $this->poster])
            ->andFilterWhere(['ilike', 'alias', $this->alias]);

        return $dataProvider;
    }
}
