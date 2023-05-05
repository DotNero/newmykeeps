<?php
namespace app\commands;
 
use Yii;
use yii\console\Controller;
use \app\rbac\UserGroupRule;
 
class RbacController extends Controller
{
    public function actionInit()
    {
        $authManager = \Yii::$app->authManager;
 
        // Create roles
        $guest  = $authManager->createRole('guest');
        $student  = $authManager->createRole('student');
        $company = $authManager->createRole('company');
        $admin  = $authManager->createRole('admin');
 
        // Create simple, based on action{$NAME} permissions
        $login  = $authManager->createPermission('login');
        $logout = $authManager->createPermission('logout');
        $error  = $authManager->createPermission('error');
        $signUp = $authManager->createPermission('signup');
        $index  = $authManager->createPermission('index');
        $view   = $authManager->createPermission('view');
        $update = $authManager->createPermission('update');
        $delete = $authManager->createPermission('delete');
 
        // Add permissions in Yii::$app->authManager
        $authManager->add($login);
        $authManager->add($logout);
        $authManager->add($error);
        $authManager->add($signUp);
        $authManager->add($index);
        $authManager->add($view);
        $authManager->add($update);
        $authManager->add($delete);
 
 
        // Add rule, based on UserExt->group === $user->group
        $userGroupRule = new UserGroupRule();
        $authManager->add($userGroupRule);
 
        // Add rule "UserGroupRule" in roles
        $guest->ruleName  = $userGroupRule->name;
        $student->ruleName  = $userGroupRule->name;
        $company->ruleName = $userGroupRule->name;
        $admin->ruleName  = $userGroupRule->name;
 
        // Add roles in Yii::$app->authManager
        $authManager->add($guest);
        $authManager->add($student);
        $authManager->add($company);
        $authManager->add($admin);
 
        // Add permission-per-role in Yii::$app->authManager
        // Guest
        $authManager->addChild($guest, $login);
        $authManager->addChild($guest, $logout);
        $authManager->addChild($guest, $error);
        $authManager->addChild($guest, $signUp);
        $authManager->addChild($guest, $index);
        $authManager->addChild($guest, $view);
 
        // BRAND
        $authManager->addChild($student, $update);
        $authManager->addChild($student, $guest);
 
        // TALENT
        $authManager->addChild($company, $update);
        $authManager->addChild($company, $guest);
 
        // Admin
        $authManager->addChild($admin, $delete);
        $authManager->addChild($admin, $student);
        $authManager->addChild($admin, $company);
    }
}