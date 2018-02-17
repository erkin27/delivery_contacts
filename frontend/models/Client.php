<?php

namespace frontend\models;


class Client extends \common\models\Client
{
    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;
    const GENDER_DEFAULT = 3;

    public function rules()
    {
        return [
            [['login', 'password', 'name', 'surname', 'gender', 'email'], 'required'],
            ['login', 'string', 'min' => 4],
            ['password', 'string', 'min' => 6],
            [['name', 'surname'], 'string'],
            [['name', 'surname'], 'match', 'pattern' => '/^[A-Z][_a-z0-9]*$/', 'message' => 'Only the first letter must be uppercase'],
            ['gender', 'integer'],
            ['email', 'email'],
            ['created', 'default', 'value' => date('c')],
            [['login', 'email'], 'unique'],
        ];
    }

    public static function getGenders()
    {
        return [
            self::GENDER_DEFAULT => '',
            self::GENDER_MALE => 'Male',
            self::GENDER_FEMALE => 'Female'
        ];
    }

    public static function getNameGender($genderId)
    {
        $genders = self::getGenders();
        if (isset($genders[$genderId])) return $genders[$genderId];
        return '';
    }
}