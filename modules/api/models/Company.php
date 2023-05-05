<?php 
namespace app\modules\api\models;

use app\models\Company as MCompany;

class Company extends MCompany
{
    public function fields()
    {
        return['id','name','number'];
    }

    public function extraFields()
    {
        return [];
    }
}