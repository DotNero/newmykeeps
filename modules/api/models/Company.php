<?php

namespace app\modules\api\models;

use Yii;
use yii\helpers\Url;
use yii\web\Linkable;

use app\models\Company as MCompany;
class Company extends MCompany
{

    public function fields()
    {
        return parent::fields();
    }
    public function extraFields()
    {
        return['vacancy'];
    }

}