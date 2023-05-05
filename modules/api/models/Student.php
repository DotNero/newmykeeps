<?php 
namespace app\modules\api\models;

use app\models\Student as MStudent;

class Student extends MStudent
{
    public function fields()
    {
        return['id','name','second_name','surname'];
    }

    public function extraFields()
    {
        return ['summary'];
    }

    public function getSummary(){
        return $this->hasMany(Summary::class,['created_by' => 'id']);
    }
}