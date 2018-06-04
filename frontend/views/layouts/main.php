<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\models\config\SysConfigMain;
use common\models\config\SysProcessRunning;
use backend\models\SysCheckProcess;
use common\models\config\SysDbVersion;
use frontend\modules\qc\models\LastErrCheck;
use backend\modules\exec\models\LastTransform;

AppAsset::register($this);

$config = SysConfigMain::find()->one();
$district = 'ไม่ตั้งค่า';
if ($config) {
    $district = $config->district_name;
}
?>


<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title>
            <?php
            //echo Html::encode($this->title);
            echo "DHDC 3.0"
            ?>
        </title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => '<span class="glyphicon glyphicon-phone"></span>',
                
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-custom navbar-fixed-top',
                ],
            ]);

            
            $rpt_mnu_itms[] = ['label' => '<i class="glyphicon glyphicon-search"></i> รายงาน HDC', 'url' => ['/hdc/default/index']];
             $rpt_mnu_itms[] = '<li class="divider"></li>';
            $rpt_mnu_itms[] = ['label' => '<i class="glyphicon glyphicon-search"></i> Data-Exchange', 'url' => ['/hdcex/default/index']];

                 
           
            $menuItems = [
                ['label' => '<i class="glyphicon glyphicon-floppy-open"></i> นำเข้า', 'url' => ['/import/upload/index']],    
            ];
            $menuItems[] = ['label' => '<i class="glyphicon glyphicon-modal-window"></i> ระบบงาน', 'url' => ['/plugin/default/index']];
            $menuItems[]=['label' => '<i class="glyphicon glyphicon-list-alt"></i> รายงาน', 'items' => $rpt_mnu_itms];
            
            if (Yii::$app->user->isGuest) {
                //$menuItems[] = ['label' => 'Signup', 'url' => ['/user/registration/register']];
                $menuItems[] = ['label' => 'เข้าระบบ', 'url' => ['/user/login']];
            } else {
                $user_items = [];
                $user_items[] = ['label' => '<i class="glyphicon glyphicon-info-sign"></i> ข้อมูลส่วนตัว', 'url' => ['/user/settings/profile', 'id' => \Yii::$app->user->id]];

                if (\Yii::$app->user->can('Backend')) {
                    $user_items[] = '<li class="divider"></li>';
                    $user_items[] = [
                        'label' => '<i class="glyphicon glyphicon-wrench"></i> จัดการระบบ',
                        'url' => \Yii::$app->urlManagerBackend->createUrl(['/site/index']),
                        'linkOptions' => ['target' => '_blank']
                    ];
                }
                $user_items[] = '<li class="divider"></li>';
                $user_items[] = ['label' => '<span class="glyphicon glyphicon-off"></span> Logout', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']];

                $menuItems[] = [
                    'label' => '<i class="glyphicon glyphicon-user"></i> ' . \Yii::$app->user->identity->username,
                    'items' => $user_items,
                ];
            }
            $menuItems[] = ['label' => 'เกี่ยวกับ', 'url' => ['/site/about']];
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
                'encodeLabels' => false,
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-left'],
                'encodeLabels' => false,
                'items' => [['label' => 'DHDC 3.0 ' . $district]],
            ]);


            NavBar::end();
            ?>

            <div class="container">
                <?php
                $running = SysProcessRunning::find()->one();
                $process = SysCheckProcess::find()->one();
                ?>
                <?php if ($running->is_running == 'true'): ?>
                    <div class="alert alert-danger"><?= $process->fnc_name ?> กำลังทำงาน (<?= $process->time ?>)</div>
                <?php endif; ?>
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>

                <?php echo \yii2mod\notify\BootstrapNotify::widget(); ?>

                <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <?php
                $db = SysDbVersion::find()->one();
                $ver = parse_ini_file(\Yii::getAlias('@version/version.ini'));
                $last_qc = LastErrCheck::find()->one();
                $last_tn = LastTransform::find()->one();
                ?>
                <div class="pull-left">
                    &copy; DHDC V.<?= $ver['number'] ?> (<?= $ver['code'] ?>)-<?= $ver['date'] ?>  (<?= $db->version; ?>)
                    <span style="margin-right: 10px"></span>
                <?= Html::img('@web/images/smc_icon.png',['width'=>'25','height'=>'25']);?>
                
                </div>
               
                <div class="pull-right">
                    <span style="margin-left: 5px">QC:<?= $last_qc->last_time ?></span>
                    <span style="margin-left: 5px">T:<?= $last_tn->last_time ?></span>
                </div>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
