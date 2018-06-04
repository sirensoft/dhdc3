<?php

namespace modules\Unitcost\controllers;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;
use modules\Unitcost\models\ChospitalAmp;
use yii\filters\AccessControl;
use components\MyHelper;
use modules\Unitcost\models\Unitcost;
use modules\Unitcost\models\UnitcostIns;
use modules\Unitcost\models\UnitcostOcc;
use modules\Unitcost\models\UnitcostNation;
use yii\web\ConflictHttpException;
/**
 * Default controller for the `Unitcost` module
 */
class DefaultController extends Controller
{
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => MyHelper::modIsOn(),
                        'roles' => ['User']
                    ],
                ]
            ]
        ];
    }
    
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionUnitcost($BYEAR=NULL,$hosname=NULL)
    {
    if (!empty($_POST['hospcode'])) {
        $m = ChospitalAmp::findOne(['hoscode'=>$_POST['hospcode'] ]);
        $hosname = $m->hosname;

        if(!empty($_POST['BYEAR'])){
            $rawData =  Unitcost::find()
                                    ->select('INCOME,INCOME_NAME,sum(COST) COST,sum(PRICE) PRICE ,sum(TOTAL) TOTAL,sum(PAYPRICE) PAYPRICE')
                                    ->where('HOSPCODE ="'.$_POST['hospcode'].'" AND BYEAR ="'.$_POST['BYEAR'].'" ')
                                    ->groupBy('INCOME,BYEAR')
                                    ->all();
        }else{
            $rawData =  Unitcost::find()
                                    ->select('INCOME,INCOME_NAME,sum(COST) COST,sum(PRICE) PRICE ,sum(TOTAL) TOTAL,sum(PAYPRICE) PAYPRICE')
                                    ->where('HOSPCODE ="'.$_POST['hospcode'].'" ')
                                    ->groupBy('INCOME,BYEAR')
                                    ->all();
        }
    }else{
        if(!empty($_POST['BYEAR'])){
            $rawData =  Unitcost::find()
                                ->select('INCOME,INCOME_NAME,sum(COST) COST,sum(PRICE) PRICE ,sum(TOTAL) TOTAL,sum(PAYPRICE) PAYPRICE')
                                ->Where('BYEAR ="'.$_POST['BYEAR'].'" ')
                                ->groupBy('INCOME,BYEAR')
                                ->all();
        }else{
        $hosname = '';
        $BYEAR = date('Y');
        $rawData = Unitcost::find()
                                ->select('INCOME,INCOME_NAME,sum(COST) COST,sum(PRICE) PRICE ,sum(TOTAL) TOTAL,sum(PAYPRICE) PAYPRICE')
                                ->WHERE('BYEAR ="'.$BYEAR.'" ')
                                ->groupBy('INCOME,BYEAR')
                                ->all();
        }
    }


        $count = count($rawData);
        if($count < 1 ){
            return $this->redirect(Yii::$app->request->referrer);
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);

        return $this->render('unitcost', [
            'dataProvider' => $dataProvider,
            'rawData' => $rawData,
            'hospcode'=>isset($_POST['hospcode'])?$_POST['hospcode']:'',
            'hosname'=>$hosname,
            'BYEAR'=>isset($_POST['BYEAR'])?$_POST['BYEAR']:$BYEAR,
        ]);
    }

    public function actionCostopd($BYEAR=NULL,$hosname=NULL)
    {
    if (!empty($_POST['hospcode'])) {
        $m = ChospitalAmp::findOne(['hoscode'=>$_POST['hospcode'] ]);
        $hosname = $m->hosname;
        if (!empty($_POST['BYEAR'])) {
            $rawData =  Unitcost::find()
                            ->where('HOSPCODE ='.$_POST['hospcode'].' AND TYPE = "OPD" AND BYEAR ="'.$_POST['BYEAR'].'" ')
                            ->groupBy('HOSPCODE,INCOME,BYEAR')
                            ->all();   
        }else{
            $rawData =  Unitcost::find()
                                ->where('HOSPCODE ='.$_POST['hospcode'].' AND TYPE = "OPD"')
                                ->groupBy('HOSPCODE,INCOME,BYEAR')
                                ->all();
        }
    }else{
        if (!empty($_POST['BYEAR'])) {
            $rawData =  Unitcost::find()
                            ->select('INCOME,INCOME_NAME,COST,PRICE,TOTAL,PAYPRICE')
                            ->where(' TYPE = "OPD" AND BYEAR ="'.$_POST['BYEAR'].'" ')
                            ->groupBy('INCOME,BYEAR')
                            ->all();   
        }else{
        $hosname = '';
        $BYEAR = date('Y');
        $rawData = Unitcost::find()
                                ->select('INCOME,INCOME_NAME,COST,PRICE,TOTAL,PAYPRICE')
                                ->where('TYPE = "OPD" AND BYEAR ="'.$BYEAR.'" ')
                                ->groupBy('INCOME,BYEAR')
                                ->all();
        }
    }
        $count = count($rawData);
        if($count < 1 ){
            return $this->redirect(Yii::$app->request->referrer);
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);

        return $this->render('costopd', [
            'dataProvider' => $dataProvider,
            'rawData' => $rawData,
            'hospcode'=>isset($_POST['hospcode'])?$_POST['hospcode']:'',
            'hosname'=>$hosname,
            'BYEAR'=>isset($_POST['BYEAR'])?$_POST['BYEAR']:$BYEAR,
        ]);
    }

    public function actionCostipd($BYEAR=NULL,$hosname=NULL)
    {
        if (!empty($_POST['hospcode'])) {
            $m = ChospitalAmp::findOne(['hoscode'=>$_POST['hospcode'] ]);
            $hosname = $m->hosname;
            if (!empty($_POST['BYEAR'])) {
                $rawData =  Unitcost::find()
                                ->where('HOSPCODE ='.$_POST['hospcode'].' AND TYPE = "IPD" AND BYEAR ="'.$_POST['BYEAR'].'" ')
                                ->groupBy('HOSPCODE,INCOME,BYEAR')
                                ->all();   
            }else{
                $rawData =  Unitcost::find()
                                    ->where('HOSPCODE ='.$_POST['hospcode'].' AND TYPE = "IPD"')
                                    ->groupBy('HOSPCODE,INCOME,BYEAR')
                                    ->all();
            }
        }else{
            if (!empty($_POST['BYEAR'])) {
                $rawData =  Unitcost::find()
                                ->select('INCOME,INCOME_NAME,COST,PRICE,TOTAL,PAYPRICE')
                                ->where(' TYPE = "IPD" AND BYEAR ="'.$_POST['BYEAR'].'" ')
                                ->groupBy('INCOME,BYEAR')
                                ->all();   
            }else{
            $hosname = '';
            $BYEAR = date('Y');
            $rawData = Unitcost::find()
                                    ->select('INCOME,INCOME_NAME,COST,PRICE,TOTAL,PAYPRICE')
                                    ->where('TYPE = "IPD" AND BYEAR ="'.$BYEAR.'" ')
                                    ->groupBy('INCOME,BYEAR')
                                    ->all();
            }
        }

        $count = count($rawData);
        if($count < 1 ){
            return $this->redirect(Yii::$app->request->referrer);
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);

        return $this->render('costipd', [
            'dataProvider' => $dataProvider,
            'rawData' => $rawData,
            'hospcode'=>isset($_POST['hospcode'])?$_POST['hospcode']:'',
            'hosname'=>$hosname,
            'BYEAR'=>isset($_POST['BYEAR'])?$_POST['BYEAR']:$BYEAR,
        ]);
    }

public function actionPrice($BYEAR=NULL,$hosname=NULL)
    {
    if (!empty($_POST['hospcode'])) {
        $m = ChospitalAmp::findOne(['hoscode'=>$_POST['hospcode'] ]);
        $hosname = $m->hosname;
        if (!empty($_POST['BYEAR'])) {
            $rawData =  Unitcost::find()
                                ->select('INCOME,INCOME_NAME,sum(COST) COST,sum(PRICE) PRICE ,sum(TOTAL) TOTAL,sum(PAYPRICE) PAYPRICE')
                                ->where('HOSPCODE ="'.$_POST['hospcode'].'" AND BYEAR ="'.$_POST['BYEAR'].'" ')
                                ->groupBy('HOSPCODE,INCOME,BYEAR')
                                ->all();
        }else{
            $rawData =  Unitcost::find()
                                ->select('INCOME,INCOME_NAME,sum(COST) COST,sum(PRICE) PRICE ,sum(TOTAL) TOTAL,sum(PAYPRICE) PAYPRICE')
                                ->where('HOSPCODE ="'.$_POST['hospcode'].'" ')
                                ->groupBy('HOSPCODE,INCOME,BYEAR')
                                ->all();
        }
    }else{
        if (!empty($_POST['BYEAR'])) {
        $rawData = Unitcost::find()
                                ->select('INCOME,INCOME_NAME,sum(COST) COST,sum(PRICE) PRICE ,sum(TOTAL) TOTAL,sum(PAYPRICE) PAYPRICE')
                                ->where('BYEAR ="'.$_POST['BYEAR'].'" ')
                                ->groupBy('INCOME,BYEAR')
                                ->all();
        }else{
            $hosname = '';
            $BYEAR = date('Y');
            $rawData = Unitcost::find()
                                    ->select('INCOME,INCOME_NAME,sum(COST) COST,sum(PRICE) PRICE ,sum(TOTAL) TOTAL,sum(PAYPRICE) PAYPRICE')
                                    ->where('BYEAR ="'.$BYEAR.'" ')
                                    ->groupBy('INCOME,BYEAR')
                                    ->all();
        }
    }
        $count = count($rawData);
        if($count < 1 ){
            return $this->redirect(Yii::$app->request->referrer);
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);

        return $this->render('price', [
            'dataProvider' => $dataProvider,
            'rawData' => $rawData,
            'hospcode'=>isset($_POST['hospcode'])?$_POST['hospcode']:'',
            'hosname'=>$hosname,
            'BYEAR'=>isset($_POST['BYEAR'])?$_POST['BYEAR']:$BYEAR,
        ]);
    }

public function actionInst($BYEAR=NULL,$hosname=NULL)
    {
    if (!empty($_POST['hospcode'])) {
        $m = ChospitalAmp::findOne(['hoscode'=>$_POST['hospcode'] ]);
        $hosname = $m->hosname;
        if (!empty($_POST['BYEAR'])) {
            $rawData =  UnitcostIns::find()
                                    ->select('INS_NAME,sum(COST) COST,sum(PRICE) PRICE ,sum(TOTAL) TOTAL,sum(PAYPRICE) PAYPRICE')
                                    ->where('HOSPCODE ="'.$_POST['hospcode'].'" AND BYEAR ="'.$_POST['BYEAR'].'" ')
                                    ->groupBy('HOSPCODE,INS_CODE,BYEAR')
                                    ->all();
        }else{
            $rawData =  UnitcostIns::find()
                                    ->select('INS_NAME,sum(COST) COST,sum(PRICE) PRICE ,sum(TOTAL) TOTAL,sum(PAYPRICE) PAYPRICE')
                                    ->where('HOSPCODE ='.$_POST['hospcode'])
                                    ->groupBy('HOSPCODE,INS_CODE,BYEAR')
                                    ->all();
        }
    }else{
        $hosname = '';
        if (!empty($_POST['BYEAR'])) {
            $rawData = UnitcostIns::find()
                                ->select('INS_NAME,sum(COST) COST,sum(PRICE) PRICE ,sum(TOTAL) TOTAL,sum(PAYPRICE) PAYPRICE')
                                ->where(' BYEAR ="'.$_POST['BYEAR'].'" ')
                                ->groupBy('INS_CODE,BYEAR')
                                ->all();
        }else{
            $BYEAR = date('Y');
            $rawData = UnitcostIns::find()
                                ->select('INS_NAME,sum(COST) COST,sum(PRICE) PRICE ,sum(TOTAL) TOTAL,sum(PAYPRICE) PAYPRICE')
                                ->where(' BYEAR ="'.$BYEAR.'" ')
                                ->groupBy('INS_CODE,BYEAR')
                                ->all();
        }
    }
        $count = count($rawData);
        if($count < 1 ){
            return $this->redirect(Yii::$app->request->referrer);
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);

        return $this->render('inst', [
            'dataProvider' => $dataProvider,
            'rawData' => $rawData,
            'hospcode'=>isset($_POST['hospcode'])?$_POST['hospcode']:'',
            'hosname'=>$hosname,
            'BYEAR'=>isset($_POST['BYEAR'])?$_POST['BYEAR']:$BYEAR,
        ]);
    }

    public function actionNation($BYEAR=NULL,$hosname=NULL)
    {
    if (!empty($_POST['hospcode'])) {
        $m = ChospitalAmp::findOne(['hoscode'=>$_POST['hospcode'] ]);
        $hosname = $m->hosname;
        if (!empty($_POST['BYEAR'])) {
            $rawData =  UnitcostNation::find()
                                ->select('NATION_NAME,sum(COST) COST,sum(PRICE) PRICE ,sum(TOTAL) TOTAL,sum(PAYPRICE) PAYPRICE')
                                ->where('HOSPCODE ="'.$_POST['hospcode'].'" AND BYEAR ="'.$_POST['BYEAR'].'" ')
                                ->groupBy('HOSPCODE,NATION,BYEAR')
                                ->all();
        }else{
            $rawData =  UnitcostNation::find()
                                ->select('NATION_NAME,sum(COST) COST,sum(PRICE) PRICE ,sum(TOTAL) TOTAL,sum(PAYPRICE) PAYPRICE')
                                ->where('HOSPCODE ="'.$_POST['hospcode'].'" ')
                                ->groupBy('HOSPCODE,NATION,BYEAR')
                                ->all();
        }
    }else{
        if (!empty($_POST['BYEAR'])) {
            $rawData = UnitcostNation::find()
                                ->select('NATION_NAME,sum(COST) COST,sum(PRICE) PRICE ,sum(TOTAL) TOTAL,sum(PAYPRICE) PAYPRICE')
                                ->where('HOSPCODE ="'.$_POST['BYEAR'].'" ')
                                ->groupBy('NATION,BYEAR')
                                ->all();
        }else{
        $hosname = '';
        $BYEAR = date('Y');
            $rawData = UnitcostNation::find()
                                ->select('NATION_NAME,sum(COST) COST,sum(PRICE) PRICE ,sum(TOTAL) TOTAL,sum(PAYPRICE) PAYPRICE')
                                ->where('HOSPCODE ="'.$BYEAR.'" ')
                                ->groupBy('NATION,BYEAR')
                                ->all();
        }
    }
        $count = count($rawData);
        if($count < 1 ){
            return $this->redirect(Yii::$app->request->referrer);
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);

        return $this->render('nation', [
            'dataProvider' => $dataProvider,
            'rawData' => $rawData,
            'hospcode'=>isset($_POST['hospcode'])?$_POST['hospcode']:'',
            'hosname'=>$hosname,
            'BYEAR'=>isset($_POST['BYEAR'])?$_POST['BYEAR']:$BYEAR,
        ]);
    }


    public function actionAec($BYEAR=NULL,$hosname=NULL)
    {
    if (!empty($_POST['hospcode'])) {
        $m = ChospitalAmp::findOne(['hoscode'=>$_POST['hospcode'] ]);
        $hosname = $m->hosname;
        if (!empty($_POST['BYEAR'])) {
            $rawData =  UnitcostNation::find()
                                    ->select('NATION_GROUP_NAME,sum(COST) COST,sum(PRICE) PRICE ,sum(TOTAL) TOTAL,sum(PAYPRICE) PAYPRICE')
                                    ->where('HOSPCODE ="'.$_POST['hospcode'].'" AND BYEAR ="'.$_POST['BYEAR'].'" ')
                                    ->groupBy('HOSPCODE,NATION_GROUP,BYEAR')
                                    ->all();
        }else{
            $rawData =  UnitcostNation::find()
                                    ->select('NATION_GROUP_NAME,sum(COST) COST,sum(PRICE) PRICE ,sum(TOTAL) TOTAL,sum(PAYPRICE) PAYPRICE')
                                    ->where('HOSPCODE ="'.$_POST['hospcode'].'" ')
                                    ->groupBy('HOSPCODE,NATION_GROUP,BYEAR')
                                    ->all();
        }
    }else{
        if (!empty($_POST['BYEAR'])) {
            $rawData = UnitcostNation::find()
                                ->select('NATION_GROUP_NAME,sum(COST) COST,sum(PRICE) PRICE ,sum(TOTAL) TOTAL,sum(PAYPRICE) PAYPRICE')
                                ->where(' BYEAR ="'.$_POST['BYEAR'].'" ')
                                ->groupBy('NATION_GROUP,BYEAR')
                                ->all();
        }else{
        $hosname = '';
        $BYEAR = date('Y');
            $rawData = UnitcostNation::find()
                                ->select('NATION_GROUP_NAME,sum(COST) COST,sum(PRICE) PRICE ,sum(TOTAL) TOTAL,sum(PAYPRICE) PAYPRICE')
                                ->where(' BYEAR ="'.$BYEAR.'" ')
                                ->groupBy('NATION_GROUP,BYEAR')
                                ->all();
        }
    }
        $count = count($rawData);
        if($count < 1 ){
            return $this->redirect(Yii::$app->request->referrer);
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);

        return $this->render('aec', [
            'dataProvider' => $dataProvider,
            'rawData' => $rawData,
            'hospcode'=>isset($_POST['hospcode'])?$_POST['hospcode']:'',
            'hosname'=>$hosname,
            'BYEAR'=>isset($_POST['BYEAR'])?$_POST['BYEAR']:$BYEAR,
        ]);
    }

    public function actionOcc($BYEAR=NULL,$hosname=NULL)
    {
    if (!empty($_POST['hospcode'])) {
        $m = ChospitalAmp::findOne(['hoscode'=>$_POST['hospcode'] ]);
        $hosname = $m->hosname;
        if (!empty($_POST['BYEAR'])) {
            $rawData =  UnitcostOcc::find()
                                    ->select('OCC_NAME,sum(COST) COST,sum(PRICE) PRICE ,sum(TOTAL) TOTAL,sum(PAYPRICE) PAYPRICE')
                                    ->where('HOSPCODE ="'.$_POST['hospcode'].'" AND BYEAR ="'.$_POST['BYEAR'].'" ')
                                    ->groupBy('HOSPCODE,OCC_CODE,BYEAR')
                                    ->all();
        }else{
            $rawData =  UnitcostOcc::find()
                                    ->select('OCC_NAME,sum(COST) COST,sum(PRICE) PRICE ,sum(TOTAL) TOTAL,sum(PAYPRICE) PAYPRICE')
                                    ->where('HOSPCODE ="'.$_POST['hospcode'].'"  ')
                                    ->groupBy('HOSPCODE,OCC_CODE,BYEAR')
                                    ->all();
        }
    }else{
        if (!empty($_POST['BYEAR'])) {
            $rawData = UnitcostOcc::find()
                                    ->select('OCC_NAME,sum(COST) COST,sum(PRICE) PRICE ,sum(TOTAL) TOTAL,sum(PAYPRICE) PAYPRICE')
                                    ->where('BYEAR ="'.$_POST['BYEAR'].'" ')
                                    ->groupBy('OCC_CODE,BYEAR')
                                    ->all();
        }else{
            $hosname = '';
            $BYEAR = date('Y');
            $rawData = UnitcostOcc::find()
                                    ->select('OCC_NAME,sum(COST) COST,sum(PRICE) PRICE ,sum(TOTAL) TOTAL,sum(PAYPRICE) PAYPRICE')
                                    ->where('BYEAR ="'.$BYEAR.'" ')
                                    ->groupBy('OCC_CODE,BYEAR')
                                    ->all();
        }
        
    }
        $count = count($rawData);
        if($count < 1 ){
            return $this->redirect(Yii::$app->request->referrer);
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);

        return $this->render('occ', [
            'dataProvider' => $dataProvider,
            'rawData' => $rawData,
            'hospcode'=>isset($_POST['hospcode'])?$_POST['hospcode']:'',
            'hosname'=>$hosname,
            'BYEAR'=>isset($_POST['BYEAR'])?$_POST['BYEAR']:$BYEAR,
        ]);
    }

}
