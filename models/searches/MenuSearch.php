<?php

namespace app\models\searches;

use app\models\Menu;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * MenuSearch represents the model behind the search form about `app\models\Menu`.
 */
class MenuSearch extends Menu
{
    public $q;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'order', 'level'], 'integer'],
            [['name', 'route', 'data', 'q'], 'safe'],
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
        $query = Menu::find();

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
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'order' => $this->order,
            'level' => $this->level,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'route', $this->route])
            ->andFilterWhere(['like', 'data', $this->data]);

        if ($this->q) {
            $query->andWhere(['!=', 'route', ''])
                ->andWhere([
                    'or',
                    ['like', 'name', $this->q],
                    ['like', 'route', $this->q]
                ]);
        }


        return $dataProvider;
    }
}
