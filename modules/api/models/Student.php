<?php 
namespace app\modules\api\models;

use app\models\Student as MStudent;

class Student extends MStudent
{
    public function fields(){
		return parent::fields();
	}


    public function extraFields()
    {
        return ['summary'];
    }
}