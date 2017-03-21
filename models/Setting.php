<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */
namespace yuncms\admin\models;

use Yii;
use yii\helpers\Json;
use yii\db\ActiveRecord;
use yii\base\DynamicModel;
use yii\base\InvalidParamException;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%setting}}".
 *
 * @property integer $id
 * @property string $type
 * @property string $section
 * @property string $key
 * @property string $value
 * @property integer $created_at
 * @property integer $updated_at
 */
class Setting extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%setting}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className()
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value'], 'string'],
            [['type', 'section', 'key'], 'required'],
            [['section', 'key'], 'string', 'max' => 255],
            [['section', 'key'], 'unique', 'targetAttribute' => ['section', 'key'], 'message' => Yii::t('admin', 'The combination of Group and Key has already been taken.')],
            ['type', 'in', 'range' => ['string', 'integer', 'boolean', 'float', 'double', 'object', 'null']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('admin', 'ID'),
            'type' => Yii::t('admin', 'Type'),
            'section' => Yii::t('admin', 'Section'),
            'key' => Yii::t('admin', 'Key'),
            'value' => Yii::t('admin', 'Value'),
            'created_at' => Yii::t('admin', 'Created At'),
            'updated_at' => Yii::t('admin', 'Updated At'),
        ];
    }

    /**
     * @param bool $forDropDown if false - return array or validators, true - key=>value for dropDown
     * @return array
     */
    public function getTypes($forDropDown = true)
    {
        $values = [
            'string' => ['value', 'string'],
            'integer' => ['value', 'integer'],
            'boolean' => ['value', 'boolean', 'trueValue' => "1", 'falseValue' => "0", 'strict' => true],
            'float' => ['value', 'number'],
            'email' => ['value', 'email'],
            'ip' => ['value', 'ip'],
            'url' => ['value', 'url'],
            'object' => [
                'value',
                function ($attribute, $params) {
                    $object = null;
                    try {
                        Json::decode($this->$attribute);
                    } catch (InvalidParamException $e) {
                        $this->addError($attribute, Yii::t('admin', '"{attribute}" must be a valid JSON object', [
                            'attribute' => $attribute,
                        ]));
                    }
                }
            ],
        ];

        if (!$forDropDown) {
            return $values;
        }

        $return = [];
        foreach ($values as $key => $value) {
            $return[$key] = Yii::t('app', $key);
        }

        return $return;
    }

    public function beforeSave($insert)
    {
        $validators = $this->getTypes(false);
        if (!array_key_exists($this->type, $validators)) {
            $this->addError('type', Yii::t('admin', 'Please select correct type'));
            return false;
        }
        $model = DynamicModel::validateData([
            'value' => $this->value
        ], [
            $validators[$this->type],
        ]);
        if ($model->hasErrors()) {
            $this->addError('value', $model->getFirstError('value'));
            return false;
        }
        if ($this->hasErrors()) {
            return false;
        }
        return parent::beforeSave($insert);
    }
}
