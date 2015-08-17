<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;
/*use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;*/

use app\models\User;
use app\assets\Need;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchQuestion */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Потенційні питання';
// $this->params['breadcrumbs'][] = $this->title;



    include('menu.php');
?>

<div class="question-index">
    <div class="row">
        <div class="col-md-5">
            <h4><?= Html::encode($this->title) ?></h4>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <p>
                <!--?= Html::a('Нове питання', ['create'], ['class' => 'btn btn-success']) ?-->
                <img src="/web/img/man1.jpg">
                <?= Html::button(
                    '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Нове питання', [
                        'value'=> Url::to('index.php?r=question/create'),
                        'class' => 'btn btn-success btn-lg',
                        'id' => 'modalButton',
                        'style' => 'vertical-align: bottom;',
                    ])
                ?>
                <?
                    if ($countOwnQ < 2) {
                        ?>
                            <script type="text/javascript">
                                //$(document).ready(function() {
                                    setTimeout(function() {
                                        modalButton.click();
                                    }, 3500);
                                //})
                            </script>
                        <?
                    }
                ?>
            </p>
            <p>
                <div class="alert alert-info" role="alert">
                    <div class="icon infoIcon" style="float: left;"></div>
                    <strong>Увага!</strong>
                    В таблиці справа завжди повинно бути мінімум два твоїх питання!!!
                </div>
            </p>

            <?php

                Modal::begin([
                    'header' => '<h4>Поповнити базу новим питанням</h4>',
                    'id' => 'modal',
                    'size' => 'modal-lg',
                ]);

                echo '<div id="modalContent"></div>';

                Modal::end();

            ?>

        </div>
        <div class="col-md-7" id="pot_quest">
            <div class="scroll">
                <?php Pjax::begin(); ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    // 'filterModel' => $searchModel,
                    'columns' => [
                        [
                            'class' => 'yii\grid\SerialColumn',
                            //'format' => '000',//['date', 'php:d-m-Y о h:i'],
                        ],

                        //'id',
                        //'npp',
                        'text:ntext',

                        [
                            'format' => 'raw',
                            /*'value' => function($data) {
                                return $data->users->username.'<br><small>'.date('d-m-Y о h:i', $data->created).'</small>';
                            },*/
                            'value' => function($data) {
                                $user = $data->users;
                                $res = '<span class="itUser"><a href="http://vk.com/id'.$user->vk_id.'" target="_blank"><img class="userAva thumbnail" src="'.Need::getAva($user).'" /></a> <span class="userName">'.$user->username.'</span></span>';
                                if (Yii::$app->user->id == $data->user_created) {
                                    $res = '<strong>'.$res.'</strong>';
                                }
                                return $res.'<small>'.date('d-m-Y о h:i', $data->created).'</small>';
                            },
                            // 'user_created',
                            'attribute' => 'user_created',
                            // 'value' => 'users.username',
                        ],
                        /*[
                            'attribute' => 'user_created',
                            'format' => 'raw',
                            'label' => '',
                            'value' => function($data) {
                                if (Yii::$app->user->can( 'edit-7progress' ) || $data->user_created == Yii::$app->user->id) {
                                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::to(['question/view', 'id' => $data->id])).'<br>'
                                    .Html::a('<span class="glyphicon glyphicon-pencil"></span>', Url::to(['question/update', 'id' => $data->id]));
                                } else {
                                    return ':)';
                                }
                            }
                        ],*/

                        /*'created' => [
                            //'class' => DataColumn::className(),
                            'attribute' => 'created',
                            'format' => ['date', 'php:d-m-Y о h:i'],
                            'label' => 'Створено',
                        ],*/

                        //'user_take',
                        //'link',

                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => Yii::$app->user->can( '7progress' )? '{view} {update} {delete}': ':)'
                            //'template' => Yii::$app->user->can( 'edit-7progress' ) || $model->user_created != Yii::$app->user->id? '{view} {update} {delete}': ':)'
                        ],
                    ],
                ]); ?>

                <?php Pjax::end(); ?>

            </div>
        </div>
    </div>

        <hr>
    <?


                $_7proItems = [
                    'user_created' => [
                        'label' => 'Автор питання',
                        'attribute' => 'user_created',
                        'value' => 'users.username',
                    ],
                    // 'link',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => Yii::$app->user->can( 'edit-7progress' )? '{update}': ':)' /*function($data) { if (Yii::$app->user->can( 'edit-7progress' )) {
                            return '{view}';
                        }*/,
                        'controller' => 'question',
                        // 'deleteOptions' => ['label' => '<i class="glyphicon glyphicon-remove"></i>']
                    ],
                ];

    ?>


    <div class="panel panel-default">
      <div class="panel-heading">Графік</div>
      <div class="panel-body" id="grafic">
            
        <?php Pjax::begin(); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider1,
            'layout'=>"{items}\n{pager}",
            // 'filterModel' => $searchModel,
            'rowOptions' => function($model) {
                if ($model->link) {
                    return ['class' => 'success'];
                    // return ['class' => 'danger'];
                } else if ($model->publiced < time()+3600*16) {
                    if ($model->publiced+3600*24 < time()) {
                        return ['class' => 'danger'];
                    } else {
                        return ['class' => 'warning'];
                    }
                }  /*else if ($model->br_status == 'active') {
                    return ['class' => 'success'];
                }*/
            },
            'columns' => [
                [
                    // 'class' => 'yii\grid\SerialColumn',
                    'format' => 'raw',
                    'attribute' => 'npp',
                    'value' => function($data) {
                        $prefix = '#';
                        if ($data->npp < 10) $prefix .= '00';
                        else if ($data->npp < 100) $prefix .= '0';
                        return $prefix.$data->npp;
                    },
                    //'format' => '000',//['date', 'php:d-m-Y о h:i'],
                ],


                'publiced' => [
                    //'class' => DataColumn::className(),
                    'attribute' => 'publiced',
                    'label' => 'Дата',
                    'options' => ['style'=> 'width: 75px'],
                    'format' => 'raw', // ['date', 'php:d-m-Y о h:i'],
                    'value' => function($data) {
                        $date = getdate($data->publiced);
                        return "<div class='pDate text-center'><div>$date[mday]-".Need::ua('mon3', $date['mon'])."</div><div>".Need::ua('wday3', $date['wday'])."</div></div>";
                    },
                    //'label' => 'Створено',
                ],

                //'id',
                //'npp',

                'user_take' => [
                    'label' => 'Автор відповіді',
                    'attribute' => 'user_take',
                    'options' => ['style'=> 'min-width: 150px'],
                    'format' => 'raw',
                    'value' => function($data) {
                        $user = $data->doers;
                        $res = '<span class="itUser"><a href="http://vk.com/id'.$user->vk_id.'" target="_blank"><img class="userAva thumbnail" src="'.Need::getAva($user).'" /></a> <span class="userName">'.$user->username.'</span></span>';
                        if (Yii::$app->user->id == $data->user_take) {
                            $res = '<strong>'.$res.'</strong>';
                        }
                        return $res;
                    }
                    // 'doers.username',
                ],

                [
                    // 'label' => 'text:ntext',
                    'attribute' => 'text',
                    'format' => 'raw',
                    'value'=>function ($data) {
                        //return Html::url('site/index');
                        if ($data->link) {
                            return Html::a(Html::encode($data->text), $data->link, ['target'=>'_blank']); // 'site/index'
                        } else {
                            return Html::encode($data->text);// Html::tag('p', Html::encode($data->text));
                        }
                        /*echo '<pre>'.print_r($data->link, true).'</pre>';
                        die('-en-');
                        return Html::a(Html::encode($data->text),'site/index');*/
                    },
                ],

                /*$_7proItems*/
                'user_created' => [
                    'label' => 'Автор питання',
                    'attribute' => 'user_created',
                    'options' => ['style'=> 'min-width: 150px'],
                    //'value' => 'users.username',
                    'format' => 'raw',
                    /*'value' => function($data) {
                        if (Yii::$app->user->id == $data->user_created) {
                            $res = '<strong>'.$data->users->username.'</strong>';
                        } else {
                            $res = $data->users->username;
                        }
                        return $res;
                    }*/
                    'value' => function($data) {
                        $user = $data->users;
                        $res = '<span class="itUser"><a href="http://vk.com/id'.$user->vk_id.'" target="_blank"><img class="userAva thumbnail" src="'.Need::getAva($user).'" /></a> <span class="userName">'.$user->username.'</span></span>';
                        if (Yii::$app->user->id == $data->user_created) {
                            $res = '<strong>'.$res.'</strong>';
                        }
                        return $res;
                    }
                ],
                // 'link',

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => Yii::$app->user->can( 'edit-7progress' )? '{update}': ':)' /*function($data) { if (Yii::$app->user->can( 'edit-7progress' )) {
                        return '{view}';
                    }*/,
                    'controller' => 'question',
                    // 'deleteOptions' => ['label' => '<i class="glyphicon glyphicon-remove"></i>']
                ],

            ],
        ]); ?>

        <?php Pjax::end(); ?>

      </div>
    </div>
    <? Need::per(['name'=>'slaawwa'], 'title'); ?>
</div>


<?php $this->registerJsFile('/web/js/newQ.js', ['depends' => [yii\web\JqueryAsset::className()]]);?>
<?php $this->registerCssFile('/web/css/newQ.css', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);?>

