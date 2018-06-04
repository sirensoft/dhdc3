<?php

namespace frontend\modules\import\controllers;

use Yii;
use frontend\modules\import\models\UploadFortythree;
use frontend\modules\import\models\UploadFortythreeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use yii\helpers\FileHelper;
use components\MyHelper;


class UploadController extends Controller {

    public $enableCsrfValidation = false;

    public function behaviors() {        

        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create','importall'],
                'rules' => [
                    
                    [
                        'actions' => ['create'],
                        'allow' => MyHelper::uploadOn(),
                        'roles' => ['User'],
                    ],
                    [
                        'actions' => ['importall'],
                        'allow' => true,
                        'roles' => ['Admin'],
                    ],
                ],
            ],
            
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'logout'=>['post']
                ],
            ],
        ];
    }

    
    public function actionIndex() {
        $path_zip = \Yii::getAlias('@webroot') . "/fortythree";
        $zipFiles = FileHelper::findFiles($path_zip, [
                    'only' => ['*.zip', '*.ZIP'],
                    'recursive' => FALSE,
        ]);
        $zip = count($zipFiles);
        if(MyHelper::user_can('Admin')){
            //MyHelper::exec_sql("CALL z_clear_upload_log;");
        }
        
       
        $searchModel = new UploadFortythreeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'zip'=>'('.$zip .')'
        ]);
    }

    
    public function actionView($id) {
        
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

   
    public function actionCreate() {
        
        
        //set_time_limit(0);
        //ini_set('max_execution_time', 1800);//ตั้งค่า php.ini
        //ini_set('post_max_size', '64M');
        //ini_set('upload_max_filesize', '64M');

        $model = new UploadFortythree();

        if ($model->load(Yii::$app->request->post())) {

            $upfile = UploadedFile::getInstance($model, 'file');
            if (!$upfile) {
                return $this->render('create', [
                            'model' => $model,
                ]);
            }
            $hos = '-';
            $hospcode = explode("_", $upfile->baseName);
            if(empty($hospcode[1])){
                 throw new \yii\web\ConflictHttpException('ชื่อไฟล์ไม่ตรงตามมาตรฐาน');
                return;
            }
            if (strtoupper($hospcode[1]) === 'F43') {
                $hos = $hospcode[2];
            } else {
                $hos = $hospcode[1];
            }
            $model->hospcode = $hos;
            $newname = $upfile->baseName . "." . $upfile->extension;
            $model->file_name = $newname;
            $model->file_size = strval(number_format($upfile->size /(1024*1024),3));
            $model->note1 = $upfile->baseName;
            $model->note2 = 'รอนำเข้า';

            $model->save(FALSE);
            $path = './fortythree/';
            $pathbackup = './fortythreebackup/';
            $upfile->saveAs($path . $newname);
            copy($path . $newname, $pathbackup . $newname);

            $ubuntu_path = "/var/lib/mysql/fortythree/";
            if (strncasecmp(PHP_OS, 'WIN', 3) !== 0) {
                //copy($path . $newname, $ubuntu_path . $newname);
            }


            return $this->redirect(['view', 'id' => $model->id]);

            //}
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    
    public function actionUpdate($id) {
        
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    
    public function actionDelete($id) {
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    
    protected function findModel($id) {
        if (($model = UploadFortythree::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDetail($filename) {

        

            return $this->render('detail', [
                        'zipname' => $filename,
            ]);
        
    }
    
      public function actionDetail2($filename) {
          

            return $this->render('detail2', [
                        
            ]);
       
    }
    
    public function actionImportall(){
        
        return $this->render('importall');
    }

}
