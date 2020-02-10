<?php

namespace frontend\controllers;

use common\models\Category;
use common\models\Product;
use common\models\ProductSearchForm;
use Yii;
use yii\data\ActiveDataProvider;


class CatalogController extends \yii\web\Controller
{
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
//            Url::remember();
            return true;
        } else {
            return false;
        }
    }

    public function actionList($id = null, $search = null)
    {
        $lookFor = new ProductSearchForm();
        $categories = Category::find()->indexBy('id')->orderBy('id')->all();
        $productsQuery = Product::find();

        if ($lookFor->load(Yii::$app->request->get()) && $lookFor->validate())
            $this->redirect(['catalog/list', 'search' => $lookFor->expression]);

        if ($search) {
            $search = trim($search);
            $productsQuery->andFilterWhere(['like', 'title', $search]);
            $lookFor->expression = $search;
        }

        if ($id !== null && isset($categories[$id])) {
            $category = Category::findOne($id);
            $productsQuery->where(['category_id' => Category::relatives($id)]);

        } else
            $category = Category::find()->all();

        $productsDataProvider = new ActiveDataProvider(['query' => $productsQuery,
            'pagination' => ['pageSize' => 1,],]);

        return $this->render('list', ['category' => $category, 'search' => $lookFor,
            'menuItems' => $this->getMenuItems($categories, isset($category->id) ? $category->id : null),
            'productsDataProvider' => $productsDataProvider,]);
    }

    public function actionView()
    {
        return $this->render('view');
    }


    /**
     * @param $categories
     * @param null $activeId
     * @param null $parent
     * @return array
     */
    private function getMenuItems($categories, $activeId = null, $parent = null)
    {
        $menuItems = [];
        foreach ($categories as $category) {
            if ($category->parent_id === $parent) {
                $menuItems[$category->id] = [
                    'active' => $activeId === $category->id,
                    'label' => $category->title,
                    'url' => ['catalog/list', 'id' => $category->id],
                    'items' => $this->getMenuItems($categories, $activeId, $category->id),
                ];
            }
        }
        return $menuItems;
    }


    /**
     * Returns IDs of category and all its sub-categories
     *
     * @param Category[] $categories all categories
     * @param int $categoryId id of category to start search with
     * @param array $categoryIds
     * @return array $categoryIds
     */
    private function getCategoryIds($categories, $categoryId, $categoryIds = [])
    {
        foreach ($categories as $category) {
            if ($category->id == $categoryId) {
                $categoryIds[] = $category->id;
            } elseif ($category->parent_id == $categoryId) {
                $this->getCategoryIds($categories, $category->id, $categoryIds);
            }
        }
        return $categoryIds;
    }
}
