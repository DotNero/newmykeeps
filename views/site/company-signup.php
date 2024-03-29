<?php

use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\modules\user\models\SignupForm */
 
$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>
 
    <p>Please fill out the following fields to signup:</p>
 
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            
            <?= $form->field($model, 'name') ?>
            <?= $form->field($model, 'description')->passwordInput() ?>
            <div class="form-group">
                <input type="button" value="Go back!" onclick="history.back()">
                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>



            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

