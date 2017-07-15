<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */
namespace yuncms\admin\models;

use Yii;
use yii\base\Model;
use yuncms\user\models\User;

/**
 * Login form
 */
class LoginForm extends Model
{

    /**
     * @var string User's email or username
     */
    public $login;

    /**
     * @var string 密码
     */
    public $password;

    /**
     * @var bool 记住我
     */
    public $rememberMe = true;

    public $verifyCode;


    /**
     * 用户组件
     * @var User
     */
    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['login', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],

            // verifyCode needs to be entered correctly
            'verifyCodeRequired' => ['verifyCode', 'required'],

            'verifyCode' => ['verifyCode', 'captcha', 'captchaAction' => '/admin/security/captcha'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, Yii::t('admin', 'Incorrect username or password.'));
            }
        }
    }

    /**
     * Logs in a user using the provided username or email and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]] or [[email]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsernameOrEmailOrMobile($this->login);
        }
        return $this->_user;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'login' => Yii::t('admin', 'Account'),
            'password' => Yii::t('admin', 'Password'),
            'rememberMe' => Yii::t('admin', 'Remember Me'),
            'verifyCode' => Yii::t('admin', 'Verify Code'),
        ];
    }
}
