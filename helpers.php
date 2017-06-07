<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */
if (!function_exists('seo')) {
    /**
     * 生成SEO
     * @param string $title 标题
     * @param string $description 描述
     * @param string $keyword 关键词
     * @return mixed
     */
    function seo($title = '', $description = '', $keyword = '')
    {
        if (!empty($title)) $title = strip_tags($title);
        if (!empty($description)) $description = strip_tags($description);
        if (!empty($keyword)) $keyword = str_replace(' ', ',', strip_tags($keyword));

        Yii::$app->view->params['site_title'] = \yuncms\admin\helpers\SettingHelper::get('title', 'site', Yii::$app->name);
        Yii::$app->view->params['keyword'] = !empty($keyword) ? $keyword : \yuncms\admin\helpers\SettingHelper::get('keywords', 'site');
        Yii::$app->view->params['description'] = isset($description) && !empty($description) ? $description : \yuncms\admin\helpers\SettingHelper::get('description', 'site');
        Yii::$app->view->params['title'] = (!empty($title) ? $title . ' - ' : '');
    }
}
