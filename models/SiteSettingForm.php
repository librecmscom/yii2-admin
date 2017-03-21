<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */
namespace yuncms\admin\models;

use Yii;
use yii\base\Model;

/**
 * Class SiteSettingForm
 * @package backend\models
 */
class SiteSettingForm extends Model
{
    public $url;
    public $name;
    public $title;
    public $keywords;
    public $description;
    public $copyright;
    public $close;
    public $closeReason;
    public $analysisCode;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['name','title', 'keywords', 'description', 'copyright', 'closeReason', 'analysisCode'], 'string'],
            ['close', 'boolean'],
            ['url', 'url']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'url' => Yii::t('admin', 'Site Url'),
            'name' => Yii::t('admin', 'Site Name'),
            'title' => Yii::t('admin', 'Site Title'),
            'keywords' => Yii::t('admin', 'Site Keywords'),
            'description' => Yii::t('admin', 'Site Description'),
            'copyright' => Yii::t('admin', 'Site Copyright'),
            'close' => Yii::t('admin', 'Site Close'),
            'closeReason' => Yii::t('admin', 'Site Close Reason'),
            'analysisCode' => Yii::t('admin', 'Site Analysis Code'),
        ];
    }
}