<!doctype html>
<html>
  <head>
      <link href="https://s3.amazonaws.com/codecademy-content/projects/bootstrap.min.css" rel="stylesheet" />
    <link href='https://fonts.googleapis.com/css?family=Roboto:500,300,700,400' rel='stylesheet' type='text/css'>
    <link href="css/main.css" rel="stylesheet" />

    <!--script src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.5/angular.min.js"></script-->
    <script src="js/angular.min.js"></script>
  </head>
  <body ng-app="myApp">
    <div class="header">
      <div class="container">
        <h1><?php echo "Тестова сторінка створена з Angular)";?></h1>
      </div>
    </div>

    <div class="main" ng-controller="MainController">
      <div class="container">

        <h1>{{ title }}</h1>
        <h2>{{ promo }}</h2>
        <hr>
        <div class="col-md-6" ng-repeat='product in products'>
          <div class="thumbnail">
            <img ng-src="{{ product.cover }}" />
            <p class="title">{{ product.name }}</p>
            <p class="price">{{ product.price | currency }}</p>
            <p class="date">{{ product.pubdate | date }}</p>
            <div class="rating">
              <p class="likes" ng-click="plusOne($index)">+{{ product.likes }}</p>
              <p class="dislikes" ng-click="minusOne($index)">-{{ product.dislikes }}</p>
            </div>
          </div>
        </div>

      </div>
    </div>

    <div class="footer">
      <div class="container">
        <h2>CONGRATULATION!!!.</h2>
        <a href="https://vk.com/slaawwa">Slaawwa</a> &copy; 2015
      </div>
    </div>


    <!-- Modules -->
    <script src="js/app.js"></script>

    <!-- Controllers -->
    <script src="js/main_controller.js"></script>
  </body> 