<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */
namespace yuncms\admin\assets;

use yii\web\AssetBundle;

class VoicecommandAsset extends AssetBundle
{

    public $sourcePath = '@Backend/Resource/assets/speech';

    public $js = [
        'voicecommand.min.js'
    ];
}