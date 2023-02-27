<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html; ?>

<?php $form = ActiveForm::begin() ?>
<?= $form -> field($model, 'username')?>
<?= $form -< field($model, 'password') -> passwordInput() ?>