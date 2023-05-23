<?php 
namespace app\modules\api\models;

use app\models\Summary as MSummary;

class Summary extends MSummary
{
    public function fields(){
		return parent::fields();
	}

    public function extraFields()
    {
        return ['tag_object'];
    }
}