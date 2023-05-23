<?php

namespace app\modules\api\controllers;

use app\modules\api\models\User;
use app\modules\api\models\LoginForm;
use Yii;


class UserController extends BaseApiController
{   
    public $modelClass = User::class;

    // public function actions()
    // {
    //     $actions = parent::actions();
        
    // }
    public function behaviors()
    {
        $behaviors = parent::behaviors();

    }
    
    
    public function actions()
    {
        $actions = parent::actions();
        //отключение методов create и delete
        unset($actions['delete'], $actions['create']);  
        return $actions;         
    }
}
