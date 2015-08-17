<?php
    /* @var $this yii\web\View */

    use yii\helpers\Url;
    $this->title = 'Творчий простір • vk-face.com';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Творчий простір!</h1>

        <p class="lead">Цей сайт є наглядним прикладом пристрасті в розробці сайтів)</p>

        <!--p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p-->
    </div>

    <div class="body-content">
        <?
            if (Yii::$app->user->can( '7progress' )) {
        ?>
        <div class="row">
          <div class="col-xs-6 col-md-3">
            <a href="<?= Url::to(['question/index']) ?>" class="thumbnail">
              <img src="http://cs622016.vk.me/v622016996/1c889/lEXtavz2LuU.jpg" alt="7progress">
            </a>
          </div>
        </div>
        <?
            }
        ?>


        <!--div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div-->

    </div>
</div>
