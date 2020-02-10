<?php


use common\models\Category;
use common\models\Product;

class SearchCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->seeElement('input', ['id' => 'productsearchform-expression']);
        $I->see('To search you ought to write keywords and push enter button', 'div');

        $cat = new Category();
        $cat->title = "trial";
        $cat->save();

        $id = Category::findOne(['title' => $cat->title])->id;

        $prod = new Product();
        $prod->title = "found";
        $prod->category_id = $id;
        $prod->save();

    }

    public function _after(FunctionalTester $I)
    {
        $cat = new Category();
        $cat::deleteAll(['title' => 'trial']);
    }

    protected function formParams($expression)
    {
        return [
            'ProductSearchForm[expression]' => $expression
        ];
    }

    // tests
    public function Find(FunctionalTester $I)
    {
        $I->submitForm('#search-form', $this->formParams('found'));
        $I->seeCurrentUrlEquals('/search/found');
        $I->see('found', '#pr-items');
    }

    public function CatchOfException(FunctionalTester $I)
    {
        $I->submitForm('#search-form', $this->formParams(''));
        $I->see('Search for purchase cannot be blank.', '.help-block');
    }
}
