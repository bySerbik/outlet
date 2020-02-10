<?php


class WelcomePageCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    // tests
    public function VisitWelcomePage(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->see('Welcome!', 'h1');

        $I->seeLink('Outlet', "/");
        $I->seeLink('Contact', "/site/contact");
        $I->seeLink('My cart', '/cart/list');
    }
}
