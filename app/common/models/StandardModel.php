<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use common\models\UploadForm;
use yii\imagine\Image;

class StandardModel extends ActiveRecord {

    public $thumbWidth = 120;
    public $thumbHeight = 120;

    // Upload file function
    public function uploadFile($attribute, $subfolder = '') {
        $returnPath = '';

        $model = new UploadForm('image');
        $model->file = UploadedFile::getInstance($this, $attribute);
        if ($model->file && $model->validate()) {

            // get the new name of file
            $newFileName = $model->file->baseName . '_' . time() . '.' . $model->file->extension;

            $model->file->saveAs(Yii::$app->params['uploadPath'] . $subfolder . '/' . $newFileName);
            $returnPath = $subfolder . '/' . $newFileName;

            // create a thumbnail
            $thumbPath = $subfolder . '/thumb/thumb-' . $newFileName;
            Image::thumbnail(Yii::$app->params['uploadPath'] . $returnPath, $this->thumbWidth, $this->thumbHeight)
                ->save(Yii::$app->params['uploadPath'] . $thumbPath, ['quality' => 80]);
        }

        return $returnPath;
    }

    // get thumbnail
    public static function getThumbnail($path) {
        if ($path) {
            $ar = explode('/', $path);
            if (!empty($ar)) {
                $last = end($ar);
                $new = 'thumb/thumb-' . $last;
                $ar[count($ar) - 1] = $new;
                return implode('/', $ar);
            }
        }

        return false;
    }

    // Upload multiple file function
    public function uploadFiles($attribute, $subfolder = '') {
        $savePath = array();
        $model = new UploadForm('image', true);
        $model->file = UploadedFile::getInstancesByName($attribute);

        if ($model->file) {

            if ($model->validate()) {
                foreach ($model->file as $file) {

                    // get the new name of file
                    $newFileName = $file->baseName . '_' . time() . '.' . $file->extension;
                    $file->saveAs(Yii::$app->params['uploadPath'] . $subfolder . '/' . $newFileName);
                    $returnPath = $subfolder . '/' . $newFileName;
                    $savePath[] = $returnPath;

                    // create a thumbnail
                    $thumbPath = $subfolder . '/thumb/thumb-' . $newFileName;
                    Image::thumbnail(Yii::$app->params['uploadPath'] . $returnPath, $this->thumbWidth, $this->thumbHeight)
                        ->save(Yii::$app->params['uploadPath'] . $thumbPath, ['quality' => 80]);

                }
            } else {
                var_dump($model->errors);die;
            }

        }

        return $savePath;
    }

    // Delete file function
    public static function deleteImage($path) {

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