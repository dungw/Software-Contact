<?php

namespace common\models;

use Yii;
use common\models\StandardModel;
use common\models\Feature;

/**
 * This is the model class for table "category".
 *
 * @property integer $cat_id
 * @property string $cat_name
 * @property string $cat_description
 * @property integer $status
 */
class Category extends StandardModel
{

    // get table name
    public static function tableName() {
        return 'category';
    }

    // get rules of validator
    public function rules()
    {
        return [
            [['cat_name'], 'required'],
            [['cat_description'], 'string'],
            [['status'], 'integer'],
            [['cat_name'], 'string', 'max' => 255]
        ];
    }

    // rewrite function attributeLabels
    public function attributeLabels()
    {
        return [
            'cat_id' => 'ID',
            'cat_name' => 'Tên danh mục',
            'cat_description' => 'Mô tả',
            'status' => 'Trạng thái',
        ];
    }

    // rewrite function _prepareDataSelect
    public static function _prepareDataSelect($models, $key, $value) {
        $data[0] = 'Chọn danh mục';
        return parent::_prepareDataSelect($models, $key, $value, $data);
    }

    // get features of category
    public static function getFeature($categoryId) {
        if ($categoryId > 0) {
            $sql = 'SELECT t1.*
                    FROM feature t1
                    INNER JOIN category_feature t2 ON(t1.id = t2.feature_id)
                    WHERE t2.category_id = '. $categoryId .' AND t1.status = '.Feature::STATUS_ACTIVE;

            $collections = Yii::$app->db->createCommand($sql)
                ->queryAll();
            return $collections;
        }
        return null;
    }

}
