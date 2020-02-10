<?php
/**
 * Created by PhpStorm.
 * User: McSerbik
 * Date: 25-Sep-17
 * Time: 1:57 AM
 */

namespace common\models;


use yii\base\Model;


class ProductSearchForm extends Model
{
    public $expression;

    public function rules()
    {
        return [
            ['expression', 'required'],
            ['expression', 'match', 'pattern' => '~^((\S|\s){1,20})$~']
        ];
    }

    public function attributeLabels()
    {
        return [
            'expression' => 'Search for purchase',
        ];
    }

}