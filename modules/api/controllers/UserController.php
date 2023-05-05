<?php

namespace app\modules\api\controllers;
use app\modules\api\models\User;
use yii\rest\ActiveController;


class UserController extends ActiveController
{   
    public $modelClass = User::class;

}
