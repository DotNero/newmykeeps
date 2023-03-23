<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'SignUP';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class = "site-signup">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Please fill out the following fields to signup:</p>

    <?php $form = ActiveForm::begin([
<<<<<<< HEAD
        'id' => 'signup-form',
=======
        'id' => 'signup-forn',
>>>>>>> 3cf1a60fb592c0a2e9ab73f08462cae40827291a
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]); ?>

<?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

<?= $form->field($model, 'password')->passwordInput() ?>
<<<<<<< HEAD

<div class="form-group">
            <div class="offset-lg-1 col-lg-11">
                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
    
    </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
=======
>>>>>>> 3cf1a60fb592c0a2e9ab73f08462cae40827291a
</div>