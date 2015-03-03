<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use common\models\UploadForm;

class StandardModel extends ActiveRecord {

    // Upload file function
    public function uploadFile($attribute, $subfolder = '') {
        $returnPath = '';

        $model = new UploadForm();
        $model->file = UploadedFile::getInstance($this, $attribute);
        if ($model->file && $model->validate()) {

            // get the new name of file
            $newFileName = $model->file->baseName . '_' . time() . '.' . $model->file->extension;
            $model->file->saveAs(Yii::$app->params['uploadPath'] . $subfolder . '/' . $newFileName);
            $returnPath = $subfolder . '/' . $newFileName;
        }

        return $returnPath;
    }

    // Upload multiple file function
    public function uploadFiles($attribute, $subfolder = '') {
        $savePath = array();
        $model = new UploadForm();
        $model->file = UploadedFile::getInstancesByName($attribute);

        if ($model->file && $model->validate()) {
            foreach ($model->file as $file) {

                // get the new name of file
                $newFileName = $file->baseName . '_' . time() . '.' . $file->extension;
                $file->saveAs(Yii::$app->params['uploadPath'] . $subfolder . '/' . $newFileName);
                $savePath[] = $subfolder . '/' . $newFileName;
            }
        }
        return $savePath;
    }

    // Delete file function
    public function deleteImage($path) {

        // check if file exists on server
        if (empty($path) || !file_exists($path)) {
            return false;
        }

        // check if uploaded file can be deleted on server
        if (!unlink($path)) {
            return false;
        }

        return true;
    }

    /**
     * @author Vuong Dung
     * @param $model
     */
    public static function prepareForSelect($models, $key, $value) {
        $data = array();
        if (!empty($models)) {
            foreach ($models as $model) {
                if (isset($model->$key) && isset($model->$value))
                $data[$model->$key] = $model->$value;
            }
        }
        return $data;
    }
}