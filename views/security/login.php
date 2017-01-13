<?php

use yii\helpers\Html;
use yii\captcha\Captcha;
use yuncms\admin\assets\LoginAsset;
use yuncms\admin\widgets\ActiveForm;

/* @var \yii\web\View $this */
/* @var ActiveForm $form */
/* @var \yuncms\admin\models\LoginForm $model */

$asset = LoginAsset::register($this);
$this->title = Yii::$app->name . ' - ' . Yii::t('admin/admin', 'Sign in');

//Meta
$this->registerMetaTag(['charset' => Yii::$app->charset]);
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no']);
$this->registerMetaTag(['name' => 'description', 'content' => 'YUNCMS Team']);
$this->registerMetaTag(['name' => 'author', 'content' => 'YUNCMS Team']);

//FAVICONS
$this->registerLinkTag(['rel' => 'shortcut icon', 'href' => $asset->baseUrl . '/img/favicon/favicon.ico', 'type' => 'image/x-icon']);
$this->registerLinkTag(['rel' => 'icon', 'href' => $asset->baseUrl . '/img/favicon/favicon.ico', 'type' => 'image/x-icon']);

//指定Web剪辑参考网页图标: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html
$this->registerLinkTag(['rel' => 'apple-touch-icon', 'href' => $asset->baseUrl . '/img/splash/sptouch-icon-iphone.png']);
$this->registerLinkTag(['rel' => 'apple-touch-icon', 'sizes' => '76x76', 'href' => $asset->baseUrl . '/img/splash/touch-icon-ipad.png']);
$this->registerLinkTag(['rel' => 'apple-touch-icon', 'sizes' => '120x120', 'href' => $asset->baseUrl . '/img/splash/touch-icon-iphone-retina.png']);
$this->registerLinkTag(['rel' => 'apple-touch-icon', 'sizes' => '152x152', 'href' => $asset->baseUrl . '/img/splash/touch-icon-ipad-retina.png']);
//iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance
$this->registerMetaTag(['name' => 'apple-mobile-web-app-capable', 'content' => 'yes']);
$this->registerMetaTag(['name' => 'apple-mobile-web-app-status-bar-style', 'content' => 'black']);

//Startup image for web apps
$this->registerLinkTag(['rel' => 'apple-touch-startup-image', 'href' => $asset->baseUrl . '/img/splash/ipad-landscape.png', 'media' => 'screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)']);
$this->registerLinkTag(['rel' => 'apple-touch-startup-image', 'href' => $asset->baseUrl . '/img/splash/ipad-portrait.png', 'media' => 'screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)']);
$this->registerMetaTag(['rel' => 'apple-touch-startup-image', 'href' => $asset->baseUrl . '/img/splash/iphone.png', 'media' => 'screen and (max-device-width: 320px)']);

?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" id="extr-page">
    <head>
        <?= Html::tag('title', Html::encode($this->title)); ?>
        <?= Html::csrfMetaTags() ?>
        <?php $this->head() ?>
    </head>
    <body class="animated fadeInDown">
    <?php $this->beginBody() ?>
    <header id="header">

        <div id="logo-group">
            <span id="logo"> <img src="<?= $asset->baseUrl?>/img/logo.png" alt="SmartAdmin"> </span>
        </div>
    </header>

    <div id="main" role="main">

        <!-- MAIN CONTENT -->
        <div id="content" class="container">

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 hidden-xs hidden-sm">
                    <h1 class="txt-color-red login-header-big"><?=Yii::t('admin/layout','Manage Center');?></h1>
                    <div class="hero">

                        <div class="pull-left login-desc-box-l">
                            <h4 class="paragraph-header">It's Okay to be Smart. Experience the simplicity of SmartAdmin,
                                everywhere you go!</h4>
                            <div class="login-app-icons">
                                <a href="javascript:void(0);" class="btn btn-danger btn-sm">Frontend Template</a>
                                <a href="javascript:void(0);" class="btn btn-danger btn-sm">Find out more</a>
                            </div>
                        </div>

                        <img src="<?= $asset->baseUrl?>/img/demo/iphoneview.png" class="pull-right display-image" alt="" style="width:210px">

                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <h5 class="about-heading">About SmartAdmin - Are you up to date?</h5>
                            <p>
                                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                                laudantium, totam rem aperiam, eaque ipsa.
                            </p>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <h5 class="about-heading">Not just your average template!</h5>
                            <p>
                                Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta
                                nobis est eligendi voluptatem accusantium!
                            </p>
                        </div>
                    </div>

                </div>
                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
                    <div class="well no-padding">
                        <?php $form = ActiveForm::begin([
                            'options' => [
                                'class' => 'smart-form client-form'
                            ],
                        ]); ?>

                        <header>
                            <?= Html::encode($this->title) ?>
                        </header>

                        <fieldset>
                            <?= $form->field($model, 'login', ['inputOptions' => [
                                'autofocus' => 'autofocus', 'autocomplete' => 'off'
                            ]])->icon('fa-user')->tooltip(Yii::t('admin/admin', 'Please enter username.')); ?>
                            
                            <?= $form->field($model, 'password')->passwordInput()->icon('fa-lock')->tooltip(Yii::t('admin/admin', 'Enter your password')); ?>

                            <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                                'captchaAction' => '/admin/security/captcha',
                                'template' => '<div class="row" style="margin-left: 0px;"><div class="col-lg-6"><i class="icon-append fa fa-file-image-o" aria-hidden="true"></i>{input}<b class="tooltip tooltip-top-right">' . Yii::t('admin/admin', 'Enter your verifyCode') . '</b></div><div class="col-lg-3">{image}</div></div>'
                            ]) ?>

                            <?= $form->field($model, 'rememberMe')->checkbox() ?>

                        </fieldset>
                        <footer>
                            <?= Html::submitButton(Yii::t('admin/admin', 'Sign in'), ['class' => 'btn btn-primary']) ?>
                        </footer>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>