<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */
namespace yii\bootstrap;

use yii\web\AssetBundle;

/**
 * Asset bundle for the Twitter bootstrap default theme.
 *
 * @author Alexander Makarov <sam@rmcreative.ru>
 * @since 2.0
 */
class BootstrapThemeAsset extends AssetBundle
{
    //public $sourcePath = '@bower/bootstrap/dist';
    public $css = [
        '//lib.baomitu.com/twitter-bootstrap/3.3.7/css/bootstrap-theme.min.css',
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
    ];
}