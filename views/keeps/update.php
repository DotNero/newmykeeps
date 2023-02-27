<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Keep $model */

$this->title = 'Update Keep: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Keeps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="keep-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
