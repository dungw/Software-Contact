<?php

namespace common\models;

use Yii;
use common\models\StandardModel;

/**
 * This is the model class for table "feature".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $status
 *
 * @property CategoryFeature[] $categoryFeatures
 */
class Feature extends StandardModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feature';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên tính năng',
            'description' => 'Mô tả',
            'status' => 'Trạng thái',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryFeatures()
    {
        return $this->hasMany(CategoryFeature::className(), ['feature_id' => 'id']);
    }
}
