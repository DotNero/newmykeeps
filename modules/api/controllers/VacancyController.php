<?php

namespace app\modules\api\controllers;

use app\modules\api\models\BasicApiController;
use app\modules\api\models\Vacancy;


class VacancyController extends BaseApiController
{   
    public $modelClass = Vacancy::class;

}