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
        'id' => 'signup-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]); ?>

<?= $form->field($model, 'mail')->textInput(['autofocus' => true]) ?>

<?= $form->field($model, 'password')->passwordInput() ?>

<!-- <button type="button" class="btn btn-primary btn-sm" name = "stundet-button" value = "student">Student</button>
<button type="button" class="btn btn-secondary btn-sm" name = "company-button" valuse = "company" onClick = "" >Company</button> -->
<script>
    function StudentButton(){
$this => $role_routing = "student";
    }
    function ConpanyButton(){
$this => $role_routing = "company"
    }
</script>


<div class="form-group">
            <div class="offset-lg-1 col-lg-11">
                <?= Html::submitButton('Student', ['class' => 'btn btn-primary', 'name' => 'student-button', 'onClick' => 'StudentButton'] ) ?>
            </div>
            <div class="offset-lg-1 col-lg-11">
                <?= Html::submitButton('Company', ['class' => 'btn btn-primary', 'name' => 'company-button', 'onClick'=>'CompanyButton']) ?>
            </div>
        </div>

<div class = "form-group">
    <div class= "offset-lg-1 col-lg-11">

    <div class="form-group">
            <div class="offset-lg-1 col-lg-11">
                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
    
    </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
</div>