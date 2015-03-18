<?php

namespace common\models;

use Yii;
use common\models\StandardModel;

/**
 * This is the model class for table "manufacture".
 *
 * @property integer $id
 * @property string $name
 * @property string $logo
 * @property string $introduction
 * @property string $address
 * @property string $phone
 * @property string $website
 * @property string $email
 * @property string $established
 *
 * @property Software[] $softwares
 */
class Manufacturer extends StandardModel
{
    const STATUS_ACTIVE = 1;
    const STATUS_DEACTIVE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'manufacture';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['introduction'], 'string'],
            [['name', 'address'], 'string', 'max' => 255],
            [['logo'], 'file', 'extensions'=>'jpg, gif, png, jpeg'],
            [['phone'], 'string', 'max' => 15],
            [['website', 'email'], 'string', 'max' => 50],
            [['established'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên công ty',
            'logo' => 'Logo',
            'introduction' => 'Giới thiệu',
            'address' => 'Địa chỉ',
            'phone' => 'Số đt liên hệ',
            'website' => 'Website',
            'email' => 'Email',
            'established' => 'Thành lập năm',
        ];
    }

    // rewrite function _prepareDataSelect
    public static function _prepareDataSelect($models, $key, $value) {
        $data[0] = 'Chọn nhà sản xuất';
        return parent::_prepareDataSelect($models, $key, $value, $data);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSoftwares()
    {
        return $this->hasMany(Software::className(), ['manufacture_id' => 'id']);
    }
}
