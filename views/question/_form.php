<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Question */
/* @var $form yii\widgets\ActiveForm */

	/*$rows = [
	    'rows' => 6,
	    'placeholder' => 'Введіть тут питання'
	];
	if (isset($upDate)) {
		$rows[] = [
			''
	    ]
	}*/

?>

<div class="question-form">

    <?php $form = ActiveForm::begin(); ?>
    <? 
    	if (isset($upDate) && Yii::$app->user->can( 'edit-7progress' )) {

	    	echo $form->field($model, 'link')->textInput(['maxlength' => 255]);

    		echo $form->field($model, 'user_take')->dropDownList(
		    	// ArrayHelper::map(User::find()->all(), 'id', 'username'),
		    	// ArrayHelper::map(User::getRoleUsers('7progress'), 'id', 'username'),
		    	ArrayHelper::map(User::findByRole('7progress'), 'id', 'username'),
		    	[
		    		'prompt' => 'Обери користувача',
		    	]
		    );
    	}
	?>

    <?= $form->field($model, 'text')->textarea([
	    'rows' => 6,
	    'placeholder' => 'Введіть тут питання'
	]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Зберегти' : 'Оновити', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
