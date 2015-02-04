<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "software".
 *
 * @property integer $id
 * @property string $name
 * @property integer $cate_id
 * @property integer $manufacture_id
 * @property string $picture
 * @property string $description
 * @property integer $user_rating
 * @property integer $price_range
 * @property string $os_support
 * @property integer $status
 *
 * @property ReviewResult[] $reviewResults
 * @property Manufacture $manufacture
 * @property SoftwareFeature[] $softwareFeatures
 */
class Software extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'software';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cate_id', 'manufacture_id', 'user_rating', 'price_range', 'status'], 'integer'],
            [['description'], 'string'],
            [['name', 'picture', 'os_support'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'cate_id' => 'Cate ID',
            'manufacture_id' => 'Manufacture ID',
            'picture' => 'Picture',
            'description' => 'Description',
            'user_rating' => 'User Rating',
            'price_range' => 'Price Range',
            'os_support' => 'Os Support',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviewResults()
    {
        return $this->hasMany(ReviewResult::className(), ['software_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManufacture()
    {
        return $this->hasOne(Manufacture::className(), ['id' => 'manufacture_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSoftwareFeatures()
    {
        return $this->hasMany(SoftwareFeature::className(), ['software_id' => 'id']);
    }
}
