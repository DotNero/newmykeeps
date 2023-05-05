<?php
namespace app\rbac;
 
use Yii;
use yii\rbac\Rule;
 
class UserGroupRule extends Rule
{
    public $name = 'userGroup';
 
    public function execute($user, $item, $params)
    {
        if (!\Yii::$app->user->isGuest) {
            $group = \Yii::$app->user->identity->group;
            if ($item->name === 'admin') {
                return $group == 'admin';
            } elseif ($item->name === 'company') {
                return $group == 'admin' || $group == 'company';
            } elseif ($item->name === 'TALENT') {
                return $group == 'admin' || $group == 'student';
            }
        }
        return true;
    }
}