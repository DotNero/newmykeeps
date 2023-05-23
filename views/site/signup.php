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
            
            <?= $form->field($model, 'mail') ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <div class="form-group">
                <input type="button" value="Go back!" onclick="history.back()">

                <div class="form-group">
            <div class="offset-lg-1 col-lg-11">
                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button', 'value' => 'student']) ?>
                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button', 'value' => 'company']) ?>
    
    </div>


            <div class="form-group">
            <div class="offset-lg-1 col-lg-11">
            
            <?=Html::radio('Role',['class' =>'btn-check', 'name'=>'role', 'value' => "student"])?>
            <?=Html::radio('Role',['class' =>'btn-check', 'name'=>'role', 'value' => "company"])?>


          </div>
            
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
