<?php 

namespace app\modules\api\controllers;
use app\modules\api\models\Student;
use yii\rest\ActiveController;

class StudentController extends ActiveController 
{
    public $modelClass = Student::class;

}