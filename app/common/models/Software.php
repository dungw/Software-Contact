<?php

namespace common\models;

use Yii;
use common\models\StandardModel;

class Software extends StandardModel
{

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
            [['cate_id', 'name', 'manufacture_id'], 'required'],
            [['cate_id', 'manufacture_id'], 'integer', 'min' => 1],
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

    // get features of software
    public function getFeatures($softwareId) {
        if ($softwareId > 0) {
            $sql = 'SELECT t1.*
                    FROM feature t1
                    INNER JOIN software_feature t2 ON(t1.id = t2.feature_id)
                    WHERE t2.software_id = '. $softwareId .' AND t1.status = '.Feature::STATUS_ACTIVE;

            $collections = Yii::$app->db->createCommand($sql)
                ->queryAll();
            return $collections;
        }
        return null;
    }

    public function getSlide($softwareId) {
        if ($softwareId > 0) {
            $slide = Yii::$app->db->createCommand('SELECT * FROM software_picture WHERE software_id = '. $softwareId)
                ->queryAll();
            return $slide;
        }
        return false;
    }
}
