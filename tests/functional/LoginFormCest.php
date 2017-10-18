<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */

class LoginFormCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnRoute('admin/security/login');
        $I->haveFixtures(['admin' => \tests\_fixtures\AdminFixture::className()]);
    }

    public function openLoginPage(\FunctionalTester $I)
    {
        $I->see('Y+', 'h1');
    }

    // demonstrates `amLoggedInAs` method
    public function internalLoginById(\FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnPage('/');
        $I->see('Logout');
    }

    // demonstrates `amLoggedInAs` method
    public function internalLoginByInstance(\FunctionalTester $I)
    {
        $I->amLoggedInAs(\yuncms\admin\models\Admin::findByUsername('admin'));
        $I->amOnPage('/');
        $I->see('Logout');
    }

    public function loginWithEmptyCredentials(\FunctionalTester $I)
    {
        $I->submitForm('#login-form', []);
        $I->expectTo('see validations errors');
        $I->see('Account cannot be blank.');
        $I->see('Password cannot be blank.');
        $I->see('Verify Code cannot be blank.');
    }

    public function loginWithWrongCredentials(\FunctionalTester $I)
    {
        $I->submitForm('#login-form', [
            'LoginForm[login]' => 'admin',
            'LoginForm[password]' => 'wrong',
            'LoginForm[verifyCode]' => 'test',
            'LoginForm[rememberMe]' => 1
        ]);
        $I->expectTo('see validations errors');
        $I->see('Incorrect username or password.');
    }

    public function loginSuccessfully(\FunctionalTester $I)
    {
        $I->submitForm('#login-form', [
            'LoginForm[login]' => 'admin',
            'LoginForm[password]' => '123456',
            'LoginForm[verifyCode]' => 'test',
            'LoginForm[rememberMe]' => 1
        ]);
        $I->see('Logout');
        $I->dontSeeElement('form#login-form');
    }
}