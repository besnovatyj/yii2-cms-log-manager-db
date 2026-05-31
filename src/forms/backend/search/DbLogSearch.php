<?php


/*
 * Copyright (c) 2026 Besnovatyj. Licensed under the MIT License.
 */

namespace Besnovatyj\LogDbManager\forms\backend\search;

use Besnovatyj\LogDbManager\entities\DbLog;
use Besnovatyj\LogDbManager\helpers\DbLogHelper;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class DbLogSearch extends Model
{
    public $id;
    public $level;
    public $category;
    public $log_time;
    public $prefix;
    public $message;

    public function rules(): array
    {
        return [
            [['id', 'level'], 'integer'],
            [['log_time'], 'double'],
            [['category', 'prefix', 'message'], 'string'],
        ];
    }

    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {
        $query = DbLog::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC]
            ],
            'pagination' => [
                'pageSize' => 100,
                'pageSizeLimit' => [15, 100],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'level' => $this->level,
            'category' => $this->category,
        ]);

        $query
            ->andFilterWhere(['like', 'message', $this->message]);

        return $dataProvider;
    }

    public function categoryList(): array
    {
        $res_arr = [];
        $tmp_arr = DbLog::find()->select(['category'])->asArray()->distinct('category')->all();
        foreach ($tmp_arr as $item) {
            foreach ($item as $value) {
                $res_arr[$value] = $value;
            }
        }
        return $res_arr;
    }

    public function levelsList(): array
    {
        return DbLogHelper::levelsList();
    }

}
