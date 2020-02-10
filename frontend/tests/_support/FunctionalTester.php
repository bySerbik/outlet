<?php


/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
 */
class FunctionalTester extends \Codeception\Actor
{
    use _generated\FunctionalTesterActions;

    /**
     * Define custom actions here
     */
    public function Order()
    {
        $I = $this;
        $I->seeInDatabase('product');
        $I->amOnPage('/');
        $I->seeLink('Add to cart');

        $I->click('Add to cart');
        $I->seeLink('My cart (1)', '/cart/list');
        $I->click('My cart (1)');
        $I->seeLink('+');
        $I->seeLink('-');
        $I->seeLink('×');
    }

}
