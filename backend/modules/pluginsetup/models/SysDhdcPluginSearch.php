<?php

namespace backend\modules\pluginsetup\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\pluginsetup\models\SysDhdcPlugin;

/**
 * SysDhdcPluginSearch represents the model behind the search form about `frontend\modules\plugin\models\SysDhdcPlugin`.
 */
class SysDhdcPluginSearch extends SysDhdcPlugin {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id'], 'integer'],
            [['name','mod_name', 'route', 'type', 'status', 'created_at', 'updated_at'], 'safe'],
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
        $query = SysDhdcPlugin::find();

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'route', $this->route])
                ->andFilterWhere(['like', 'type', $this->type])
                ->andFilterWhere(['like', 'status', $this->status])
                ->andFilterWhere(['like', 'mod_name', $this->mod_name]);

        return $dataProvider;
    }

}
