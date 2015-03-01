<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use common\models\UploadForm;

class StandardModel extends ActiveRecord {

    /**
     * Process upload of image
     *
     * @return mixed the uploaded image instance
     */
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

    /**
     * Process deletion of image
     *
     * @return boolean the status of deletion
     */
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
}