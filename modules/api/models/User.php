<?php 
namespace app\modules\api\models;

use app\models\User as ModelsUser;

class User extends ModelsUser
{
    public function fields(){
		$fields =  parent::fields();

        unset($fields['auth_key'],$fields['password'],$fields['password_reset_token'],$fields['access_token'],$fields['mail_confirm_token']);
        return $fields;
	}


    public function extraFields()
    {
        return [
            'company',
            'student',
        ];
    }
}