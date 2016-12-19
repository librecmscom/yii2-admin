<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AdminMenu;

/**
 * Menu represents the model behind the search form about [[\common\models\AdminMenu]].
 */
class AdminMenuSearch extends AdminMenu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent', 'sort'], 'integer'],
            [['name', 'route', 'parent_name'], 'safe'],
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
     * Searching menu
     * @param array $params
     * @return \yii\data\ActiveDataProvider
     */
    public function search($params)
    {
        $query = AdminMenu::find()
            ->from(AdminMenu::tableName() . ' t')
            ->joinWith(['menuParent' => function ($q) {
                $q->from(AdminMenu::tableName() . ' parent');
            }]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        $sort = $dataProvider->getSort();
        $sort->attributes['menuParent.name'] = [
            'asc' => ['parent.name' => SORT_ASC],
            'desc' => ['parent.name' => SORT_DESC],
            'label' => 'parent',
        ];
        $sort->attributes['sort'] = [
            'asc' => ['parent.sort' => SORT_ASC, 't.sort' => SORT_ASC],
            'desc' => ['parent.sort' => SORT_DESC, 't.sort' => SORT_DESC],
            'label' => 'sort',
        ];
        $sort->defaultOrder = ['menuParent.name' => SORT_ASC];

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            't.id' => $this->id,
            't.parent' => $this->parent,
        ]);

        $query->andFilterWhere(['like', 'lower(t.name)', strtolower($this->name)])
            ->andFilterWhere(['like', 't.route', $this->route])
            ->andFilterWhere(['like', 'lower(parent.name)', strtolower($this->parent_name)]);

        return $dataProvider;
    }
}