<?php


class LoginCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnPage('/admin');
        $I->seeLink('Login');
        $I->click('Login');
        $I->seeCurrentUrlEquals('/backend/web/index.php?r=user%2Flogin');
    }

    public function _after(FunctionalTester $I)
    {
    }

    protected function formParams($login, $password)
    {
        return [
            'LoginForm[username]' => $login,
            'LoginForm[password]' => $password,
        ];
    }

    //tests
    public function CatchOfException(FunctionalTester $I)
    {
        $I->submitForm('#login-form', $this->formParams('', ''));
        $I->seeElement('.help-block-error');
    }

    public function Login(FunctionalTester $I)
    {
        $I->submitForm('#login-form', $this->formParams('admin', 'admin'));

        $I->amOnPage('/backend/web/');
        $I->seeLink('Logout (admin)');
        $I->dontSeeLink('Login');
        $I->click('Logout (admin)');
        $I->seeLink('Login');
    }
}
