<?php

namespace common\models;

use Yii;

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
class Manufacturer extends \yii\db\ActiveRecord
{
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
            [['name', 'logo', 'address'], 'string', 'max' => 255],
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
            'name' => 'Name',
            'logo' => 'Logo',
            'introduction' => 'Introduction',
            'address' => 'Address',
            'phone' => 'Phone',
            'website' => 'Website',
            'email' => 'Email',
            'established' => 'Established',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSoftwares()
    {
        return $this->hasMany(Software::className(), ['manufacture_id' => 'id']);
    }
}
