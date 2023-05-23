<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use app\models\User;
/**
 * Инициализатор RBAC выполняется в консоли php yii my-rbac/init
 */
class RbacController extends Controller {

    public function actionInit() {
        $auth = Yii::$app->authManager;
        
        
        // Создадим роли админа и редактора новостей
        $admin = $auth->createRole('admin');
        $user_au = $auth->createRole('user_au');
        $student = $auth->createRole('student');
        $company = $auth->createRole('company');
        $help = $auth->createRole('help');
        
        
        // запишем их в БД
        $auth->add($admin);
        $auth->add($user_au);
        $auth->add($student);
        $auth->add($company);
        $auth->add($help);
        
        $roleAdministrator = Yii::$app->authManager->getRole('admin');
        Yii::$app->authManager->assign($roleAdministrator, 71);
        
        
        // Создаем разрешения. Например, просмотр админки viewAdminPage и редактирование новости updateNews
        
        $studentSignup = $auth->createPermission('studentSignup');
        $studentSignup->description = 'Регистрация студента';

        $companySignup = $auth->createPermission('companySignup');
        $companySignup->description = 'Создание компании';
        
        // Запишем эти разрешения в БД
        $auth->add($studentSignup);
        $auth->add($companySignup);
        
        // Теперь добавим наследования. Для роли editor мы добавим разрешение updateNews,
        // а для админа добавим наследование от роли editor и еще добавим собственное разрешение viewAdminPage
        
        // Роли «Редактор новостей» присваиваем разрешение «Редактирование новости»

        // админ наследует роль редактора новостей. Он же админ, должен уметь всё! :D
        $auth->addChild($admin, $user_au);
        
        // Еще админ имеет собственное разрешение - «Просмотр админки»
        $auth->addChild($admin, $studentSignup);

}
}