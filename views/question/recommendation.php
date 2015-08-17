<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchQuestion */
/* @var $dataProvider yii\data\ActiveDataProvider */


    include('menu.php');

$this->title = 'Рекомендації';
/*$this->params['breadcrumbs'][] = [
    'label' => '7progress',
    'url' => ['question/index'],
];
$this->params['breadcrumbs'][] = $this->title;*/
?>
<style type="text/css">
    ol li {
        margin: 25px;
    }
    .img-limit {
        width: 100%;
        /*max-width: 700px;
        -webkit-transition: all 0.3s ease-in;*/
    }
    /*.img-limit:hover {
        max-width: 100%;
    }*/
    .cont {
        padding: 25px;
    }
    .panel-body div img {
        float: left;
        margin-right: 15px;
    }
</style>
<div class="question-index cont">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="panel panel-default">
      <div class="panel-heading">1) План</div>
      <div class="panel-body">
        <div>
            <img class="thumbnail" src="http://cs625726.vk.me/v625726996/1e8d8/NdRaWatIo-4.jpg">
            Записати короткий план, що висвітлює проблему даного питання
        </div>
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-heading">2) Зробити потрібний запис (по плану)</div>
      <div class="panel-body">
        <div>
            <img class="thumbnail" src="http://cs625726.vk.me/v625726996/1e8ba/_lsYgSspHkc.jpg">
            Але переглянути рекомендації до попередніх публікацій <br>
            Нічого страшного, якщо перший десяток буде дуже кривий і матиме багато помилок.<br>
            Це все виправиться, якщо над цим працювати)))
        </div>
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-heading">3) MP3</div>
      <div class="panel-body">
        <div>
            <div>
                Якщо у запис з телефону, то завантажити на комп, або на сервіс, що дає url<br>
                та переформатувати запис в mp3<br>
                <a href="http://audio.online-convert.com/ru/convert-to-mp3" target="_blank">http://audio.online-convert.com/ru/convert-to-mp3</a><br>
                При бажанні можна обрізати, додати фонову музику - одним словом монтаж)<br>
            </div>
            <img class="thumbnail" src="http://cs625726.vk.me/v625726996/1e8c1/n_69GI8XB5c.jpg">
        </div>
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-heading">4) Завантаження MP3</div>
      <div class="panel-body">
        <div>
            <div>
                <a href="https://vk.com/audios-84423647" target="_blank">Завантажити mp3 у альбом групи</a> <br>
                Підредагувати інфу про mp3 приблизно так
            </div>
            <img class="thumbnail img-limit" src="http://cs625726.vk.me/v625726996/1e8ca/2xQ2JiS_wC4.jpg">
        </div>
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-heading">5) Завантаження зображення</div>
      <div class="panel-body">
        <div>
            <div>
                <a href="https://vk.com/album-84423647_209560508" target="_blank">Зробити тематичну картинку. Та залити її у альбом</a><br>
                Приблизного формат
            </div>
            <img class="thumbnail" src="http://cs625726.vk.me/v625726996/1e8d1/5wY49rLVwog.jpg">
        </div>
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-heading">6) Публікація</div>
      <div class="panel-body">
        <div>
            <div>
                Описати кількома рядками Вашу роботу на стіні групи, прикріпити до неї картинку та mp3
            </div>
            <img class="thumbnail" src="http://cs625726.vk.me/v625726996/1e8e6/8D5ohebCYuc.jpg">
        </div>
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-heading">7) Результат</div>
      <div class="panel-body">
        <div>
            <div>
                Прослухати ще раз Вашу роботу, та прокоментувати.<br>
                Що Ви б надалі хотіли виправити у наступних записах чи що на Вашу думку потребує обговорення
            </div>
            <img class="thumbnail" src="http://cs625726.vk.me/v625726996/1e8ed/7rR-Wu4EGnM.jpg">
        </div>
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-heading">8) Фінішна крапка</div>
      <div class="panel-body">
        <div>
            <div>
                Додати наступне завдання <a href="<?=Url::to(['question/create'])?>" target="_blank">сюди</a><br>
                А також не забувати давати поради та допомагати іншим учасникам, що виклали свої роботи)
            </div>
            <img class="thumbnail" src="http://cs625726.vk.me/v625726996/1e8f4/lVXIlxCLgpU.jpg">
        </div>
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-heading">9) Щястя</div>
      <div class="panel-body">
        <div>
            <div>
                Насолоджуватися та отримувати задоволення від виконаної роботи
            </div>
            <img class="thumbnail" src="http://cs625726.vk.me/v625726996/1e8fb/u40cF6P4avo.jpg">
        </div>
      </div>
    </div>

</div>
