<?php


class CartPageCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    // tests
    public function VisitCartPage(AcceptanceTester $I)
    {
        $I->amOnPage('/cart/list');
        $I->see('Your cart', '//body//div//div/h1');

        $I->see('Price', '.row');
        $I->see('Quantity', '.row');
        $I->see('Cost', '.row');
        $I->seeLink('Order', '/cart/order');
    }
}
