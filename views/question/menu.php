<?

    use yii\bootstrap\Nav;
    use yii\bootstrap\NavBar;

            NavBar::begin([
                'brandLabel' => '7progress',
                'brandUrl' => ['/question/index'],//'http://vk.com/7progress', //Yii::$app->homeUrl,
                'options' => [
                    // 'class' => 'navbar-inverse navbar-fixed-top',
                    'class' => 'navbar navbar-default',
                ],
                // 'brandOptions' => ['target' => '_blank'],
            ]);

            if (Yii::$app->user->isGuest) {
                $items = [
                    ['label' => 'Вхід', 'url' => ['/site/login']]
                ];   
            } else {


                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav'],
                    'items' => [
                        [
                            'label' => 'Рекомендації',
                            // 'url' => 'https://vk.com/topic-84423647_31400105',
                            'url' => ['question/recommendation'],
                            // 'linkOptions' => ['target' => '_blank'],
                        ],
                    ],
                ]);
                
                $items = [
                    [
                        'label' => 'VK-спільнота', 
                        'url' => 'http://vk.com/7progress',
                        'linkOptions' => ['target' => '_blank'],
                    ],
                ];
                /*$items = [
                    ['label' => 'Додому', 'url' => ['/question/index']],
                    ['label' => 'Вийти (' . Yii::$app->user->identity->username . ')',
                                'url' => ['/site/logout'],
                                'linkOptions' => ['data-method' => 'post']],
                ];*/
            }

            echo Nav::widget([
                'options' => [
                    'class' => 'navbar-nav navbar-right',
                    'style' => 'margin-right: 0;'
                ],
                'items' => $items,
            ]);

            NavBar::end();
        ?>