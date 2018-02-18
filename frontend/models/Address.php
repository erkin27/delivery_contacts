<?php

namespace frontend\models;


class Address extends \common\models\Address
{
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['index', 'country', 'city', 'street', 'house'], 'required'],
            ['country', 'match', 'pattern' => '/^[A-Z]{2}$/', 'message' => 'Only uppercase letters'],
            ['index', 'match', 'pattern' => '/^[\d_-]+$/'],
        ]);
    }
}