<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */
namespace yuncms\admin\controllers;

use yii\web\Controller;

class SettingController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'setting' => [
                'class' => 'yuncms\admin\actions\SettingAction',
                'modelClass' => 'yuncms\admin\models\SiteSettingForm',
                'group' => 'site',
            ],
        ];
    }
}