<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */
namespace yuncms\admin\actions;

use Yii;
use yii\base\Action;
use yuncms\admin\helpers\SettingHelper;

/**
 * Class SettingAction
 * @package yuncms\admin\actions
 */
class SettingAction extends Action
{
    /**
     * @var string class name of the model which will be used to validate the attributes.
     * The class should have a scenario matching the `scenario` variable.
     * The model class must implement [[Model]].
     * This property must be set.
     */
    public $modelClass;

    /**
     * @var string The scenario this model should use to make validation
     */
    public $scenario;

    /**
     * @var string the name of the view to generate the form. Defaults to 'settings'.
     */
    public $viewName = 'setting';

    /**
     * @var string 分组
     */
    public $group;

    /**
     * Render the settings form.
     */
    public function run()
    {
        /* @var $model \yii\db\ActiveRecord */
        $model = new $this->modelClass();
        if ($this->scenario) {
            $model->setScenario($this->scenario);
        }

        if (!$this->group) {
            $this->group = $model->formName();
        }
        $this->group = strtolower($this->group);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            foreach ($model->toArray() as $key => $value) {
                SettingHelper::set($key, $value, $this->group);
            }
            Yii::$app->getSession()->addFlash('success', Yii::t('admin', 'Successfully saved settings.'));
        }
        foreach ($model->attributes() as $key) {
            $model->{$key} = SettingHelper::get($key, $this->group);
        }
        return $this->controller->render($this->viewName, ['model' => $model]);
    }
}
