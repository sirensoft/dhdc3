<?php

namespace modules\adhoc\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use modules\adhoc\models\DhdcAdhoc;

/**
 * DhdcAdhocSearch represents the model behind the search form about `modules\adhoc\models\DhdcAdhoc`.
 */
class DhdcAdhocSearch extends DhdcAdhoc {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id'], 'integer'],
            [['title', 'sql_sum','sql_indiv', 'date_begin', 'date_end', 'type', 'note1', 'note2', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = DhdcAdhoc::find();

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
            'id' => $this->id,
            'date_begin' => $this->date_begin,
            'date_end' => $this->date_end,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
                ->andFilterWhere(['like', 'type', $this->type])
                ->andFilterWhere(['like', 'sql_sum', $this->sql_sum])
                ->andFilterWhere(['like', 'sql_indiv', $this->sql_indiv])
                ->andFilterWhere(['like', 'created_by', $this->created_by])
                ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }

}
