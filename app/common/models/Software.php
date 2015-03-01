<?php

namespace common\models;

use Yii;
use common\models\StandardModel;

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
class Software extends StandardModel
{
    public $_statusData = array(
        0 => 'Không sử dụng',
        1 => 'Kích hoạt',
    );

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
            'name' => 'Tên phần mềm',
            'cate_id' => 'Danh mục',
            'manufacture_id' => 'Nhà sản xuất',
            'picture' => 'Ảnh',
            'description' => 'Mô tả',
            'user_rating' => 'Đánh giá',
            'price_range' => 'Khoảng giá',
            'os_support' => 'Hệ điều hành',
            'status' => 'Trạng thái',
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
