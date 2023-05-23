<?php 

namespace app\modules\api\controllers;

use app\modules\api\models\BasicApiController;
use app\modules\api\models\Summary;

class SummaryController extends BaseApiController
{
    public $modelClass = Summary::class;

}