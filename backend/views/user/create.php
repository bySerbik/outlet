<?php
/**
 * Created by PhpStorm.
 * User: McSerbik
 * Date: 22-Aug-17
 * Time: 1:47 AM
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Roles;

$form = ActiveForm::begin(); ?>
<?= $form->field($model, 'username'); ?>
<?= $form->field($model, 'email') ?>
<?= $form->field($model, 'password_hash')->passwordInput() ?>
<?= $form->field($model, 'confirmation_password')->passwordInput() ?>
<?= $form->field($model, 'role')->dropDownList([
    Roles::GUEST_ROLE => Roles::GUEST_ROLE,
    Roles::MANAGER_ROLE => Roles::MANAGER_ROLE,
    Roles::ADMIN_ROLE => Roles::ADMIN_ROLE,]) ?>
<?= Html::submitButton('Submit') ?>
<?php ActiveForm::end() ?>

