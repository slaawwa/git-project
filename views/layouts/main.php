<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\widgets\Alert;
use app\assets\Need;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'VK-face.com',
                'brandUrl' => Yii::$app->homeUrl, // 'http://vk.com/7progress'
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
                // 'brandOptions' => ['target' => '_blank'],
            ]);

            if (Yii::$app->user->isGuest) {
                $items = [
                    ['label' => '<span class="glyphicon glyphicon-user"></span> Вхід', 'url' => ['/site/login']]
                ];   
            } else {


                echo Nav::widget([
                    // 'encodeLabels' => false,
                    'options' => ['class' => 'navbar-nav'],
                    'items' => [
                        /*[
                            'label' => 'Рекомендації',
                            'url' => 'https://vk.com/topic-84423647_31400105',
                            'linkOptions' => ['target' => '_blank'],
                        ],*/
                    ],
                ]);
                
                $items = [
                    // ['label' => 'Додому', 'url' => ['/question/index']],
                    [
                        'label' => '<img class="thumbnail" style="width: 40px;margin: 0;display: inline;" src="'.(Yii::$app->user->identity->ava? Yii::$app->user->identity->ava: Need::pro7gress('defAva')).'"/> ' . Yii::$app->user->identity->username,
                        'options' => ['class' => 'userBut', 'style' => 'padding: 0px;'],
                        'items' => [
                            Yii::$app->user->identity->vk_id? [
                                'label' => '<li role="presentation"><span class="glyphicon glyphicon-user"></span> Вконтакті</li>',
                                'url' => 'http://vk.com/id'.Yii::$app->user->identity->vk_id,
                                'linkOptions' => ['target' => '_blank'],
                            ]:'<li></li>',
                            '<li role="presentation" class="divider"></li>',
                            [
                                'label' => '<span class="glyphicon glyphicon-off"></span> Вийти',
                                'url' => ['/site/logout'],
                                'linkOptions' => ['data-method' => 'post'],
                                    // 'image' => ['src' => Yii::$app->user->identity->ava],
                            ],
                        ],
                    ],
                ];
            }

            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'encodeLabels' => false,
                'items' => $items /*[
                    Yii::$app->user->isGuest ?
                        [] :
                        ['label' => 'Додому', 'url' => ['/question/index']],
                    //['label' => 'About', 'url' => ['/site/about']],
                    //['label' => 'Contact', 'url' => ['/site/contact']],
                    Yii::$app->user->isGuest ?
                        ['label' => 'Вхід', 'url' => ['/site/login']] :
                        ['label' => 'Вийти (' . Yii::$app->user->identity->username . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                ],*/
            ]);

            NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left"><a id="copyrightLink" target='_blank'></a> &copy; VK-face.com <?= date('Y') ?></p>
            <p class="pull-right"><i class="footer_right"></i>Потужність технологій Yii2</p>
        </div>
    </footer>

<?php $this->endBody() ?>
        <script type='text/javascript'>
          $(function() {
              $.getJSON('https://googledrive.com/host/0B5fPAPZ_rvy-S0N2QWVPaEpVbFE/link.json', function(data) {
                $('#copyrightLink').html(data.label).attr('href', data.link).attr('title', data.title);
              });
          })
          
        </script>
        <!--LiveInternet counter--><script type="text/javascript"><!--
        $('.footer_right').append("<a href='//www.liveinternet.ru/click' "+
        "target=_blank><img src='//counter.yadro.ru/hit?t28.12;r"+
        escape(document.referrer)+((typeof(screen)=="undefined")?"":
        ";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
        screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
        ";h"+escape(document.title.substring(0,80))+";"+Math.random()+
        "' alt='' title='LiveInternet: показана кількість переглядів і"+
        " відвідувачів' "+
        "border='0' width='88' height='120'><\/a>")
        //--></script><!--/LiveInternet-->

</body>
</html>
<?php $this->endPage() ?>
