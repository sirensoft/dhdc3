<?php

namespace frontend\assets;

class SweetAlertAsset extends \yii\web\AssetBundle
{
    public $sourcePath = 'js';
    public $css = [
        'swal/sweetalert.css',
    ];
    public $js = [
        'swal/sweetalert.min.js'
    ];
}

