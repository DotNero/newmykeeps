<?php

use yii\helpers\Html;
 
/* @var $this yii\web\View */
/* @var $user app\modules\user\models\User */
 
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['controllers/site/password-reset', 'token' => $user->password_reset_token]);
?>
 
Здравствуйте, <?= Html::encode($user->mail) ?>!
 
Пройдите по ссылке, чтобы сменить пароль:
 
<?= Html::a(Html::encode($resetLink), $resetLink) ?>