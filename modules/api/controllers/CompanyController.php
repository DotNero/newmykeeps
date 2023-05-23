<?php 

namespace app\modules\api\controllers;

use app\modules\api\models\BasicApiController;
use app\modules\api\models\Company;


class CompanyController extends BaseApiController
{
    public $modelClass = Company::class;

}