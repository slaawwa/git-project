<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Question */

/*if (Yii::$app->request->isAjax) {
  echo "<h1>Test</h1>";
} else {*/

	$this->title = 'Нове питання';
	$this->params['breadcrumbs'][] = ['label' => 'Questions', 'url' => ['index']];
	$this->params['breadcrumbs'][] = $this->title;
	?>
	<div class="question-create">

	    <h1><?= Html::encode($this->title) ?></h1>

	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>

	</div>
<?
//}
?>
