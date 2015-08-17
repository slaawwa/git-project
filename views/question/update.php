<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Question */

$this->title = 'Редагування питання: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Питання', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => '№'.$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редагування';
?>
<div class="question-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'upDate' => true,
    ]) ?>

</div>
