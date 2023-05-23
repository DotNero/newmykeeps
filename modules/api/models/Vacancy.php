<?php 
namespace app\modules\api\models;

use app\models\Vacancy as MVacancy;

class Vacancy extends MVacancy
{
    public function fields(){
		return parent::fields();
	}


    public function extraFields()
    {
        return ['tag_object'];
    }
}