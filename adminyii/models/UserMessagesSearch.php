<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UserMessages;

/**
 * UserMessagesSearch represents the model behind the search form about `app\models\UserMessages`.
 */
class UserMessagesSearch extends UserMessages
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['request_message', 'response_message', 'user_name', 'created_at'], 'safe'],
            [['user_id', 'user_messages_id'], 'integer'],
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
        $query = UserMessages::find();

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
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'user_messages_id' => $this->user_messages_id,
        ]);

        $query->andFilterWhere(['like', 'request_message', $this->request_message])
            ->andFilterWhere(['like', 'response_message', $this->response_message])
            ->andFilterWhere(['like', 'user_name', $this->user_name]);

        return $dataProvider;
    }
}
