<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Question;

/**
 * SearchQuestion represents the model behind the search form about `app\models\Question`.
 */
class SearchQuestion extends Question
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'npp', 'created', 'user_take'], 'integer'],
            [['user_created', 'text', 'link'], 'safe'],
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
        $query = Question::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,//->where('link',
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('users');

        $query->andFilterWhere([
            'id' => $this->id,
            'npp' => $this->npp,
             'created' => $this->created,
            //'user_created' => $this->user_created,
            'user_take' => $this->user_take,
        ]);

        $query->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'user.username', $this->user_created]);

        return $dataProvider;
    }

    public function allPotenc($params) {
        $query = Question::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,//->where('link',
            'sort' => [
                // Set the default sort by name ASC and created_at DESC.
                'defaultOrder' => [
                    //'name' => SORT_ASC, 
                    'created' => SORT_DESC
                ]
            ],
            'pagination' => [
                // 'pageSize' => 3,
                'pageSize' => 50,
            ],
        ]);$this->load($params);

        $query->where('npp=0');

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('link=""');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'user_created' => $this->user_created,
            // 'com_id' => $this->com_id,
            // 'br_created' => $this->br_created,
        ]);

        return $dataProvider;
    }


    public function allDo($params) {
        $query = Question::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,//->where('link',
            'sort' => [
                // Set the default sort by name ASC and created_at DESC.
                'defaultOrder' => [
                    //'name' => SORT_ASC, 
                    'npp' => SORT_DESC
                ]
            ],
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);$this->load($params);

        $query->where('npp!=0');

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('link=""');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'user_created' => $this->user_created,
            // 'com_id' => $this->com_id,
            // 'br_created' => $this->br_created,
        ]);

        return $dataProvider;
    }
}