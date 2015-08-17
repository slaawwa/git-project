app.controller('MainController', ['$scope', function($scope) { 
  $scope.title = 'Зразок сайту'; 
  $scope.promo = 'А це мої CD диски';
  $scope.products = [{
    name: 'Останній диск з моєї колекції',
    price: 19,
    pubdate: new Date('2014', '03', '08'),
    cover: 'http://pc-azbuka.ru/wp-content/uploads/2013/03/pic_197.jpg',
    likes: 0,
    dislikes: 0,
  }, {
    name: 'Перший диск з моєї колекції',
    price: 8,
    pubdate: new Date('2013', '08', '01'),
    cover: 'http://pc-azbuka.ru/wp-content/uploads/2013/03/pic_197.jpg',
    likes: 0,
    dislikes: 0,
  }, {
    name: 'Тут Поплавський співає пісню про кропиву',
    price: 1,
    pubdate: new Date('2010', '10', '29'),
    cover: 'http://pc-azbuka.ru/wp-content/uploads/2013/03/pic_197.jpg',
    likes: 0,
    dislikes: 0,
  }, {
    name: 'Тут Поплавський дуже натхненно співає пісню про кропиву',
    price: 2,
    pubdate: new Date('1992', '02', '29'),
    cover: 'http://pc-azbuka.ru/wp-content/uploads/2013/03/pic_197.jpg',
    likes: 0,
    dislikes: 0,
  }];
  $scope.minusOne = function(index) {
    $scope.products[index].dislikes += 1;
  };
  $scope.plusOne = function(index) {
    $scope.products[index].likes += 1;
  };
}]);