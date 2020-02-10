<?php


use common\models\Category;
use common\models\Product;

class OrderCest
{
    public function _before(FunctionalTester $I)
    {
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

    // tests
    public function Order(FunctionalTester $I)
    {
        $I->Order();
    }
}
