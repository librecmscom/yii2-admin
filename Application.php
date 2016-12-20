<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */
namespace yuncms\admin;

use Yii;

/**
 * Class Application
 * @package yuncms\admin
 */
class Application extends \yii\web\Application
{

    /**
     * @inheritdoc
     */
    protected function bootstrap()
    {
        parent::bootstrap();
        //附加权限验证行为
        $this->attachBehavior('access', Yii::createObject([
            'class' => 'yuncms\admin\components\AccessControl'
        ]));
        Yii::$classMap['yii\jui\JuiAsset'] = '@yuncms/admin/extends/JuiAsset.php';
        Yii::$classMap['yii\helpers\Html'] = '@yuncms/admin/extends/Html.php';
        //锁定布局
        $this->layout = '@yuncms/admin/views/layouts/main';
    }

    /**
     * Returns the URL manager for this application.
     * @return \yii\web\UrlManager the URL manager for this application.
     */
    public function getFrontUrlManager()
    {
        return $this->get('frontUrlManager');
    }

    /**
     * @inheritdoc
     */
    public function coreComponents()
    {
        //增加或重置一些系统默认组件的默认配置
        return array_merge(parent::coreComponents(), [
            'request' => [
                'class' => 'yii\web\Request',
                'csrfParam' => '_csrf-backend',
            ],
            'session' => [
                'class' => 'yii\web\Session',
                'name' => 'backend',
            ],
            'user' => [
                'class' => 'yii\web\User',
                'enableAutoLogin' => true,
                'loginUrl' => ['/admin/security/login'],
                'identityClass' => 'yuncms\admin\models\Admin',
                'identityCookie' => [
                    'name' => '_identity-backend',
                    'httpOnly' => true
                ],
            ],
            //定义authManager
            'authManager' => [
                'class' => 'yuncms\admin\components\RbacManager',
                'cache' => 'cache',
            ],
            'urlManager' => [
                'class' => 'yii\web\UrlManager',
                'rules' => [
                    'login' => '/admin/security/login',
                    'logout' => '/admin/security/logout',
                ],
            ],
            'frontUrlManager' => [
                'class' => 'yii\web\UrlManager',
            ],

        ]);
    }

}