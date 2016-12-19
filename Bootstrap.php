<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */

namespace yuncms\admin;

use Yii;
use yii\web\Cookie;
use yii\base\BootstrapInterface;
use common\helpers\SettingHelper;

/**
 * Class Bootstrap
 * @package backend
 */
class Bootstrap implements BootstrapInterface
{
    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param \yii\base\Application $app the application currently running
     */
    public function bootstrap($app)
    {
        //自动检测语言
        if (($language = Yii::$app->request->getQueryParam('language')) !== null) {
            $app->language = $language;
            Yii::$app->response->cookies->add(new Cookie(['name' => 'language', 'value' => $language]));
        } else if (($cookie = Yii::$app->request->cookies->get('language')) !== null) {
            $app->language = $cookie->value;
        } else if (($language = Yii::$app->request->getPreferredLanguage()) !== null) {
            $app->language = $language;
        }

        $app->set('authManager', [
            'class' => 'yuncms\admin\components\RbacManager',
            'cache' => 'cache',
        ]);

        //设置前台URL
        $app->frontUrlManager->baseUrl = SettingHelper::get('frontendUrl','site');


        //附加权限验证行为
        $app->attachBehavior('access', Yii::createObject([
            'class' => 'yuncms\admin\components\AccessControl'
        ]));

        $app->urlManager->addRules([
            'login' => '/site/login',
            'logout' => '/site/logout',
            'error' => '/site/error',
        ], false);
    }
}