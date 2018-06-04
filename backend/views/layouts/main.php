<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\models\config\SysDbVersion;
use frontend\modules\qc\models\LastErrCheck;
use backend\modules\exec\models\LastTransform;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title>DHDC 3.0</title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => 'DHDC 3.0 Backend',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-custom navbar-fixed-top',
                ],
            ]);
            $menuItems[] = ['label' => '<i class="glyphicon glyphicon-home"></i> หน้าหลัก', 'url' => \Yii::$app->homeUrl];
            if (\Yii::$app->user->can('Admin')) {
                $menuItems[] = ['label' => 'จัดการผู้ใช้', 'url' => ['/user/admin/index']];
            }
            if (\Yii::$app->user->can('Admin')) {
                $menuItems[] = ['label' => 'สิทธิใช้งาน', 'url' => ['/gate/default/rbac-gate']];
            }
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Login', 'url' => ['/user/security/login']];
            } else {
                $menuItems[] = [
                    'label' => '<span class="glyphicon glyphicon-user"></span> ' . \Yii::$app->user->identity->username,
                    'items' => [
                        ['label' => '<i class="glyphicon glyphicon-info-sign"></i> ข้อมูลส่วนตัว', 'url' => ['/user/settings/profile', 'id' => \Yii::$app->user->id]],
                        '<li class="divider"></li>',
                        ['label' => '<span class="glyphicon glyphicon-off"></span> Logout', 'url' => ['/user/security/logout'], 'linkOptions' => ['data-method' => 'post']],
                    ],
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
                'encodeLabels' => false,
            ]);
            NavBar::end();
            ?>

            <div class="container">
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
                <div class="pull-left">&copy; DHDC V.<?= $ver['number'] ?> (<?= $ver['code'] ?>)-<?= $ver['date'] ?>  (<?= $db->version; ?>)</div>

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
