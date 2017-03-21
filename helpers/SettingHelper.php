<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */
namespace yuncms\admin\helpers;

use Yii;
use yii\db\Query;
use yii\caching\TagDependency;
use yii\helpers\ArrayHelper;
use yuncms\admin\models\Setting;

/**
 * Class SettingHelper
 * @package common\helpers
 */
class SettingHelper
{
    const CACHE_TAG = 'admin.setting';

    private static $settings;

    /**
     * Checks to see if a setting exists.
     * If $searchDisabled is set to true, calling this function will result in an additional query.
     * @param $key
     * @param string|null $sgroup
     * @param boolean $searchDisabled
     * @return boolean
     */
    public function has($key, $group = null, $searchDisabled = false)
    {
        if ($searchDisabled) {
            return Setting::find()->where(['key' => $key, 'section' => $group])->exists();
        } else {
            static::loadSettings();
            return isset(static::$settings[$group][$key]);
        }
    }

    /**
     * @return Setting[]
     */
    public function getAll()
    {
        static::loadSettings();
        return static::$settings;
    }

    /**
     * Get's the value for the given key and section.
     * You can use dot notation to separate the section from the key:
     * $value = $settings->get('group.key');
     * and
     * $value = $settings->get('key', 'group');
     * are equivalent
     *
     * @param $key
     * @param string|null $group
     * @param string|null $default
     * @return mixed
     */
    public static function get($key, $group = null, $default = null)
    {
        if (is_null($group)) {
            $pieces = explode('.', $key, 2);
            if (count($pieces) > 1) {
                $group = $pieces[0];
                $key = $pieces[1];
            } else {
                $group = '';
            }
        }
        static::loadSettings();
        if (isset(static::$settings[$group][$key][0])) {
            if (static::$settings[$group][$key][1] !== 'object') {
                settype(static::$settings[$group][$key][0], static::$settings[$group][$key][1]);
            }
        } else {
            static::$settings[$group][$key][0] = $default;
        }
        return static::$settings[$group][$key][0];
    }

    /**
     * 保存一个设置
     * @param $key
     * @param $value
     * @param null $group
     * @param null $type
     * @return boolean
     */
    public static function set($key, $value, $group = null, $type = null)
    {
        if (is_null($group)) {
            $pieces = explode('.', $key);
            $group = $pieces[0];
            $key = $pieces[1];
        }

        $model = Setting::findOne(['group' => $group, 'key' => $key]);
        if ($model === null) {
            $model = new Setting();
        }
        $model->group = $group;
        $model->key = $key;
        $model->value = strval($value);
        if ($type !== null) {
            $model->type = $type;
        } else {
            $model->type = gettype($value);
        }
        if ($model->save()) {
            static::invalidateCache();
            return true;
        }
        return false;
    }

    /**
     * Deletes a setting
     *
     * @param $key
     * @param null|string $group
     * @return bool
     */
    public static function delete($key, $group = null)
    {
        if (is_null($group)) {
            $pieces = explode('.', $key);
            $group = $pieces[0];
            $key = $pieces[1];
        }
        $model = Setting::findOne(['group' => $group, 'key' => $key]);
        if ($model && $model->delete()) {
            static::invalidateCache();
        }
        return true;
    }

    /**
     * 加载设置
     * @param bool $refresh
     */
    public static function loadSettings($refresh = false)
    {
        $key = __METHOD__;
        if (YII_DEBUG || static::$settings === null || $refresh || Yii::$app->cache === null || ((static::$settings = Yii::$app->cache->get($key)) === false)) {
            $settings = (new Query)->from(Setting::tableName())->all();
            static::$settings = array_merge_recursive(
                ArrayHelper::map($settings, 'key', 'value', 'group'),
                ArrayHelper::map($settings, 'key', 'type', 'group')
            );
            if (Yii::$app->cache !== null) {
                Yii::$app->cache->set($key, static::$settings, 0, new TagDependency (['tags' => static::CACHE_TAG]));
            }
        }
    }

    /**
     * 使缓存失效
     */
    public static function invalidateCache()
    {
        if (Yii::$app->cache != null) {
            TagDependency::invalidate(Yii::$app->cache, static::CACHE_TAG);
        }
        static::$settings = null;
        static::loadSettings();
    }
}