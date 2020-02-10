<?php

namespace frontend\models;

use common\models\Category;
use common\models\Product;
use Yii;
use yii\web\UrlRule;

class SefRules extends UrlRule
{
    public $connectionID = 'db';

    public function init()
    {
        if ($this->name === null) $this->name = __CLASS__;
    }

    public function createUrl($manager, $route, $params)
    {

        switch ($route) {
            case 'catalog/list':
                if (isset($params['search']) && isset($params['page']))
                    return "search/" . $params['search'] . "/page/" . $params['page'];
                elseif (isset($params['search']))
                    return "search/" . $params['search'];


                if (isset($params['id'])) {
                    $category = Category::findOne($params['id']);
                    if (isset($params['page']))
                        return "/catalog/list/$category->title/page/" . $params['page'];
                    else
                        return "/catalog/list/$category->title";
                } elseif (isset($params['page']))
                    return "/catalog/page/" . $params['page'];

                break;
        }
        return false;
    }


    public function parseRequest($manager, $request)
    {
        $pathInfo = $request->getPathInfo();

        /* for search with pagination */
        if (preg_match("~^search\/((\S|\s){1,20})\/page\/([0-9]{1,9})$~", $pathInfo, $matches)) {
            $expression = $matches[1];
            $expression = trim($expression);
            $page = $matches[3];
            return ['catalog/list', ['search' => $expression,'page' => $page, 'per-page' => --$page]];
        }

        /* for search */
        if (preg_match("~^search/((\S|\s){1,20})$~", $pathInfo, $matches)) {
            $expression = $matches[1];
            $expression = trim($expression);

            return ['catalog/list', ['search' => $expression]];
        }

        /* for common catalog  */
        if (preg_match("~^catalog/page/([0-9])+$~", $pathInfo, $matches)) {
            $page = $matches[1];
            return ['catalog/list', ['page' => $page, 'per-page' => --$page]];
        }

        /* for (name) catalog with pagination */
        if (preg_match("~^catalog/list/((\S|\s){1,20})/page/([0-9])+$~", $pathInfo, $matches)) {
            $category_id = Category::findOne(['title' => $matches[1]]);
            $id = $category_id->id;
            $page = $matches[3];
            return ['catalog/list', ['id' => $id, 'page' => $page, 'per-page' => --$page]];

        }
        /* for (name) catalog  */
        if (preg_match("~^catalog/list/((\S|\s){1,20})$~", $pathInfo, $matches)) {
            $category_id = Category::findOne(['title' => $matches[1]]);
            $id = $category_id->id;
            return ['catalog/list', compact('id')];
        }

        return false;
    }
}

