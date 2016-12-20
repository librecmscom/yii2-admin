<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */
namespace yuncms\admin\widgets;

use yii\helpers\Url;
use yii\helpers\Json;
use yii\widgets\InputWidget;
use yuncms\admin\assets\UEditorAsset;
use yii\helpers\Html;

/**
 * Class UEditor
 * @package backend
 */
class UEditor extends InputWidget
{

    /**
     * @var array the options for the UEditor JS plugin.
     * @see http://ueditor.baidu.com/
     */
    public $clientOptions = [];

    /**
     * {@inheritDoc}
     * @see \yii\base\Object::init()
     */
    public function init()
    {
        parent::init();
        $this->clientOptions = array_merge([
            'autoHeight' => true,
            'serverUrl'=>Url::to(['/upload/ueditor']),
        ], $this->clientOptions);
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        UEditorAsset::register($this->view);
        if ($this->hasModel()) {
            echo Html::activeTextarea($this->model, $this->attribute, $this->options);
        } else {
            echo Html::textArea($this->name, $this->value, $this->options);
        }
        $options = empty ($this->clientOptions) ? '' : Json::htmlEncode($this->clientOptions);
        $this->view->registerJs("UE.getEditor('{$this->options ['id']}',{$options});");
    }

}

