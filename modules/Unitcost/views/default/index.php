<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="Unitcost-default-index">
<?php
$this->params['breadcrumbs'][] = ['label' => 'ข้อมูลค่าบริการ', 'url' => ['index']];
//$this->params['breadcrumbs'][] = "แบ่งตาม TYPEAREA";
?>
<?php 
echo Html::a('<div class="notice notice-info">
                <strong>ต้นทุนความค่าบริการ</strong>
            </div>',
             ['/Unitcost/default/unitcost']);
echo Html::a('<div class="notice notice-danger">
                <strong>ต้นทุนความค่าบริการ ผู้ป่วยนอก</strong>
            </div>',
             ['/Unitcost/default/costopd']);
echo Html::a('<div class="notice notice-info">
                <strong>ต้นทุนความค่าบริการ ผู้ป่วยใน</strong>
            </div>',
             ['/Unitcost/default/costipd']);
echo Html::a('<div class="notice notice-danger">
                <strong>ประเมินค่าใช้จ่ายจริงในสถานบริการ</strong>
            </div>',
             ['/Unitcost/default/price']);
echo Html::a('<div class="notice notice-info">
                <strong>ต้นทุนความค่าบริการ กลุ่มสิทธิ์</strong>
            </div>',
             ['/Unitcost/default/inst']);
echo Html::a('<div class="notice notice-danger">
            <strong>ต้นทุนความค่าบริการ แยกอาชีพ</strong>
            </div>',
            ['/Unitcost/default/occ']);
echo Html::a('<div class="notice notice-info">
            <strong>ต้นทุนความค่าบริการ แยกสัญชาติ</strong>
            </div>',
            ['/Unitcost/default/nation']);
echo Html::a('<div class="notice notice-danger">
            <strong>ต้นทุนความค่าบริการ แยกสัญชาติ AEC</strong>
            </div>',
            ['/Unitcost/default/aec']);
?>

</div>
<?php
$css=<<<CSS
.notice {
    padding: 15px;
    background-color: #fafafa;
    border-left: 6px solid #7f7f84;
    margin-bottom: 10px;
    -webkit-box-shadow: 0 5px 8px -6px rgba(0,0,0,.2);
       -moz-box-shadow: 0 5px 8px -6px rgba(0,0,0,.2);
            box-shadow: 0 5px 8px -6px rgba(0,0,0,.2);
}
.notice-success {
    border-color: #80D651;
}
.notice-success>strong {
    color: #80D651;
}
.notice-info {
    border-color: #45ABCD;
}
.notice-warning {
    border-color: #FEAF20;
}
.notice-danger {
    border-color: #d73814;
}
CSS;
$this->registerCss($css);
?>

