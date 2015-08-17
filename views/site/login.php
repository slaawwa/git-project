<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Авторизація';
// $this->params['breadcrumbs'][] = $this->title;


// <script src="" type="text/javascript"></script>

//$this->registerJsFile('//vk.com/js/api/openapi.js', ['depends' => [yii\web\JqueryAsset::className()]]);

/* VK init script for auth */
?>
<script src="//vk.com/js/api/openapi.js" type="text/javascript"></script>

<div class="site-login">

    <div class="center-block" style="width: 700px;
background-color: white;
min-height: 390px;
border-radius: 10px;">
        <div class="col-md-12"><h1><?= Html::encode($this->title) ?></h1></div>
        <div class="col-md-4">
            <div class="panel panel-default">
              <div class="panel-heading">Вхід через вконтакті:</div>
              <div class="panel-body text-center">
                <?= Html::button(
                    '<img src="'.Yii::$app->params['static'].'img/vk1.png" />',
                    [
                        'class' => 'btn btn-default',
                        'style' => 'margin: 17px 0;',
                        'name' => 'vk-login-button',
                        'id' => 'login_button',
                    ]
                ) ?>
              </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Класичний варіант входу:</div>
                <div class="panel-body">
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                        <?= $form->field($model, 'email') ?>
                        <?= $form->field($model, 'password')->passwordInput() ?>
                        <?= $form->field($model, 'rememberMe')->checkbox() ?>
                        <div style="color:#999;margin:1em 0;" class="pull-right">
                            <?= Html::a('Забули пароль', ['site/request-password-reset']) ?>.
                            <?= Html::a('Реєстрація', ['site/signup']) ?>.
                        </div>
                        <div class="form-group">
                            <?= Html::submitButton('Вхід', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    
        VK.init({
            apiId: <?=Yii::$app->params['VK_APP_ID']?>
        });
        function authInfo(response) {
            if (response.session) {
                console.log(response.session)
                console.log('user: '+response.session.mid);
                $('#login_button').attr('disabled', 'disabled');
                top.location.reload();
            } else {
              console.log('not auth');
            }
        }
        function authExit(res) {
            console.log(res)
        }
        //VK.Auth.getLoginStatus(authInfo);
        //VK.UI.button('login_button');

        VK.Observer.subscribe("auth.login", function f(){
            console.log("Thank you for auth site.");

            error_deb = false;
            $('h1').click(function() {
                error_deb = true;
                $('#login_button').removeAttr('disabled');
            })
            /*setTimeout(function() {
                if (!error_deb) {*/
                    //top.location.reload();
                /*}
            }, 1500)*/
        });

        VK.Observer.subscribe("auth.logout", function f() {
            console.log("Thank you for use site.");
        });

</script>

<?php $this->registerJsFile('/web/js/login.js', ['depends' => [yii\web\JqueryAsset::className()]]);?>
<?php $this->registerCssFile('/web/css/login.css', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);?>