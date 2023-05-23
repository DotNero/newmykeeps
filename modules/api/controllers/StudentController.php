<?php 

namespace app\modules\api\controllers;

use app\modules\api\models\BasicApiController;
use app\modules\api\models\Student;

class StudentController extends BaseApiController
{
    public $modelClass = Student::class;

}