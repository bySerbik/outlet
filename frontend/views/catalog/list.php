<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;
use yii\widgets\Menu;

/* @var $this yii\web\View */
$title = !isset($category->title) ? 'Welcome!' : $category->title;
$this->title = Html::encode($title);
?>


<h1><?= Html::encode($title) ?></h1>

<div class="container-fluid">
    <div class="row">
        <div class="col-xs-4">
            <?= Menu::widget([
                'items' => $menuItems,
                'options' => [
                    'class' => 'menu',
                ],
            ]) ?>
        </div>

        <div class="col-xs-8">

            <?php $form = ActiveForm::begin(['method' => 'get', 'id' => 'search-form']); ?>
            <?= $form->field($search, 'expression')->hint('To search you ought to write keywords and push enter button') ?>
            <?php ActiveForm::end() ?>

            <?= ListView::widget([
                'dataProvider' => $productsDataProvider,
                'itemView' => '_product',
                'summary' => '',
                'options' => [
                    'id' => 'pr-items'
                ]
            ]) ?>
        </div>
    </div>
</div>
