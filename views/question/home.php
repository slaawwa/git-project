<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchQuestion */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Потенційні питання';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Додати нове питання', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                //'format' => '000',//['date', 'php:d-m-Y о h:i'],
            ],

            //'id',
            //'npp',
            'text:ntext',
            'user_created',

            'created' => [
                //'class' => DataColumn::className(),
                'attribute' => 'created',
                'format' => ['date', 'php:d-m-Y о h:i'],
                'label' => 'Створено',
            ],

            //'user_take',
            //'link',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
