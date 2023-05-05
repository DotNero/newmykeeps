<?php 

namespace app\modules\api\controllers;
use app\modules\api\models\Company;
use yii\rest\ActiveController;

class CompanyController extends ActiveController 
{
    public $modelClass = Company::class;

}