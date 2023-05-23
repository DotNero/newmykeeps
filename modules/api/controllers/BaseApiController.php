<?php 
namespace app\modules\api\controllers;

use yii\rest\ActiveController;
use app\modules\api\models\User;
use yii\HttpBasicAuth;
use yii\web\Response;

class BaseApiController extends ActiveController
{   
    //обвёртка для данных
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;
        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['delete'], $actions['create'], $actions['view']);
        return $actions;
    }

  
}
