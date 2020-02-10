<?php


class AdminAcessCest
{
    public function _before(FunctionalTester $I)
    {
    }

    public function _after(FunctionalTester $I)
    {
    }

    // tests
    public function notAccess(FunctionalTester $I)
    {
        $I->amOnPage('/admin');
        $I->dontSeeLink('Create User');
    }

    public function Access(FunctionalTester $I)
    {
        $I->amOnPage('/backend/web/user/login');
        $I->seeCurrentUrlEquals('/backend/web/user/login');

        $I->submitForm('#login-form', $this->formParams('admin', 'admin'));
        $I->SeeLink('Create User');

    }

    protected function formParams($login, $password)
    {
        return [
            'LoginForm[username]' => $login,
            'LoginForm[password]' => $password,
        ];
    }
}
