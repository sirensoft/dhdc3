<?php 
namespace frontend\modules\import\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $dataFile;
    public $fname;

    public function rules()
    {
        return [
            [['dataFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'zip'],
        ];
    }
    
    public function upload()
    {
        $d = date('YmdHis');
        if ($this->dataFile->saveAs('data'.$d.'.'.$this->dataFile->extension)) {            
            $this->fname = 'data'.$d. '.'.$this->dataFile->extension;
            return true;
        } else {
            return false;
        }
    }
}