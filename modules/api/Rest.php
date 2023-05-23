<?php

namespace app\modules\api;

use yii\filters\AccessControl;
use yii\filters\auth\HttpBasicAuth;
use app\modules\api\models\User;
use Yii;


/**
 * api module definition class
 */
class Rest extends \yii\base\Module
{   
    /**
     * {@inheritdoc}
     */ 
    public $controllerNamespace = 'app\modules\api\controllers';

    // public function behabiors()
    // {
    //     $behaviors = parent::behaviors();
    //     $behaviors['authenticator'] = ['class' => HttpBasicAuth::class];

    // }
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        \Yii::$app->user->enableSession = false;
        // custom initialization code goes here
    }

    // public function behaviors()
    // {  
    //     $behaviors = parent::behaviors();
  
    //     $behaviors['contentNegotiatior']=[
    //         'class' => \yii\filters\ContentNegotiator::class,
    //         'formatParam' => 'format',
    //         'formats' => [
    //             'application/json' => \yii\web\Response::FORMAT_JSON,
    //             'application/xml' => \yii\web\Response::FORMAT_XML,
                
    //         ],
    //     ];
    //     return $behaviors; 
    // }
}
