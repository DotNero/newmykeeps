<?php 

namespace app\modules\api\controllers;

use app\modules\api\models\BasicApiController;
use app\modules\api\models\Offer;

class OfferController extends BaseApiController
{
    public $modelClass = Offer::class;

}