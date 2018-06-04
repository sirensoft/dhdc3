<?php

namespace frontend\modules\import\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\import\models\SysDhdcImportError;

/**
 * SysDhdcImportErrorSearch represents the model behind the search form about `frontend\modules\import\models\SysDhdcImportError`.
 */
class SysDhdcImportErrorSearch extends SysDhdcImportError
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['date_err', 'err'], 'safe'],
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
        $query = SysDhdcImportError::find();

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
            'date_err' => $this->date_err,
        ]);

        $query->andFilterWhere(['like', 'err', $this->err]);

        return $dataProvider;
    }
}
