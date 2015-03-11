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

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    public function getFeature($categoryId) {
        if ($categoryId > 0) {
            $sql = 'SELECT t1.*
                    FROM feature t1
                    INNER JOIN category_feature t2 ON(t1.id = t2.feature_id)
                    WHERE t2.category_id = '. $categoryId .' AND t1.status = '.Feature::STATUS_ACTIVE;

            $collations = Yii::$app->db->createCommand($sql)
                ->queryAll();
            return $collations;
        }
        return null;
    }

    public function showStatus() {
        if (!empty($this->_statusData)) {
            foreach ($this->_statusData as $key=>$value) {
                if ($key == $this->status) return $value;
            }
        }
        return false;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_name'], 'required'],
            [['cat_description'], 'string'],
            [['status'], 'integer'],
            [['cat_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cat_id' => 'ID',
            'cat_name' => 'Tên danh mục',
            'cat_description' => 'Mô tả',
            'status' => 'Trạng thái',
        ];
    }
}
