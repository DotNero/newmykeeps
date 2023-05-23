<?php
use yii\helpers\Html;
 
/* @var $this yii\web\View */
/* @var $user app\modules\user\models\User */
 
$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['controllers/site/email-confirm', 'token' => $user->mail_confirm_token]);
?>
 
Здравствуйте, <?= Html::encode($user->mail) ?>!
 
Для подтверждения адреса пройдите по ссылке:
 
<?= Html::a(Html::encode($confirmLink), $confirmLink) ?>
 
Если Вы не регистрировались у на нашем сайте, то просто удалите это письмо.