<?php

namespace common\models;

use Yii;
use common\models\StandardModel;

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

    public $_statusData = array(
        1 => 'Kích hoạt',
        0 => 'Không sử dụng',
    );

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
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
