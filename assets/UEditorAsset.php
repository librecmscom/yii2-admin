<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */
namespace yuncms\admin\assets;

use yii\web\AssetBundle;

class UEditorAsset extends AssetBundle
{
    public $basePath = '@webroot';

    public $baseUrl = '@web';

    public $css = [
        'js/plugins/ueditor/themes/iframe.css',
    ];

    public $js = [
        'js/plugins/ueditor/ueditor.config.js',
        'js/plugins/ueditor/ueditor.all.min.js',
    ];
}