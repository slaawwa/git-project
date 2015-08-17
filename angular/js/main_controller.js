app.controller('MainController', ['$scope', function($scope) { 
  $scope.title = 'Title)'; 
  $scope.promo = 'Promo';
  $scope.products = [{
    name: 'The Book of Trees',
    price: 19,
    pubdate: new Date('2014', '03', '08'),
    cover: 'http://pc-azbuka.ru/wp-content/uploads/2013/03/pic_197.jpg',
    likes: 0,
    dislikes: 0,
  }, {
    name: 'Program or be Programmed',
    price: 8,
    pubdate: new Date('2013', '08', '01'),
    cover: 'http://pc-azbuka.ru/wp-content/uploads/2013/03/pic_197.jpg',
    likes: 0,
    dislikes: 0,
  }, {
    name: 'CD1',
    price: 0,
    pubdate: new Date('2010', '10', '29'),
    cover: 'http://pc-azbuka.ru/wp-content/uploads/2013/03/pic_197.jpg',
    likes: 0,
    dislikes: 0,
  }, {
    name: 'CD2',
    price: 0,
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