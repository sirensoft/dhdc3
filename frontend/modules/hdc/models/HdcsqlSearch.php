<?php

namespace frontend\modules\hdc\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\hdc\models\Hdcsql;

/**
 * HdcsqlSearch represents the model behind the search form about `backend\models\Hdcsql`.
 */
class HdcsqlSearch extends Hdcsql {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['rpt_id', 'rpt_name', 'sql_indiv', 'note_indiv', 'sql_sum', 'note_sum', 'sql_check', 'tb_source', 'dupdate', 'note1', 'note2', 'note3'], 'safe'],
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
        $query = Hdcsql::find();

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
            'dupdate' => $this->dupdate,
        ]);

        $query->andFilterWhere(['like', 'rpt_id', $this->rpt_id])
                ->andFilterWhere(['like', 'rpt_name', $this->rpt_name])
                ->andFilterWhere(['like', 'sql_indiv', $this->sql_indiv])
                ->andFilterWhere(['like', 'note_indiv', $this->note_indiv])
                ->andFilterWhere(['like', 'sql_sum', $this->sql_sum])
                ->andFilterWhere(['like', 'note_sum', $this->note_sum])
                ->andFilterWhere(['like', 'sql_check', $this->sql_check])
                ->andFilterWhere(['like', 'tb_source', $this->tb_source])
                ->andFilterWhere(['like', 'note1', $this->note1])
                ->andFilterWhere(['like', 'note2', $this->note2])
                ->andFilterWhere(['like', 'note3', $this->note3]);

        return $dataProvider;
    }

}
