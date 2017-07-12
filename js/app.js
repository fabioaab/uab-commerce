// app.js

var app = angular.module('app', ["ngRoute"]);

app.config(['$routeProvider', '$locationProvider', function ($routeProvider, $locationProvider) {

    $routeProvider
        .when('/uab-commerce', {
            templateUrl: '/uab-commerce/pages/home.php',
            controller: 'mainController'
        })

        .when('/uab-commerce/home', {
            templateUrl: '/uab-commerce/pages/home.php',
            controller: 'mainController'
        })

        .when('/uab-commerce/login', {
            templateUrl: '/uab-commerce/pages/login.html',
            controller: 'mainController'
        })

        .when('/uab-commerce/signin', {
            templateUrl: '/uab-commerce/pages/signin.html',
            controller: 'mainController'
        })

        .when('/uab-commerce/administracao/:entidade', {
            templateUrl: function (urlattr) {
                return '/uab-commerce/pages/administracao-' + urlattr.entidade + '.php';
            },
            controller: 'crudController'
        }).otherwise({
            templateUrl: 'uab-commerce/pages/administracao-produto.php'
        });

    $locationProvider.html5Mode(true);
}]);

app.controller('crudController', function ($scope, $http, $routeParams) {

    var entidade = $routeParams.entidade;

    var obter = function (entidade) {
        $http.get('/uab-commerce/services.php/' + entidade + 's').then(function (response) {
            $scope.objetos = response.data;
        });
    }

    $scope.escolher = function (objeto) {
        $http.get('/uab-commerce/services.php/' + entidade + '/' + objeto.id).then(function (response) {
            $scope.objeto = response.data;
        });
    }

    $scope.excluir = function (objeto) {
        $http.delete('/uab-commerce/services.php/' + entidade + '/' + objeto.id).then(function (response) {
            obter(entidade);
        });
    }

    $scope.salvar = function (objeto, ) {

        if (!objeto.id) {
            $http.post('/uab-commerce/services.php/' + entidade, objeto).then(
                function (response) {
                    $scope.sucesso = true;
                    $scope.mensagem = "Registro cadastrado com sucesso!";
                    $scope.objeto = {};
                    obter(entidade);
                },
                function (response) {
                    $scope.objeto = response.data;
                    $scope.erro = true;
                    $scope.mensagem = "Oooopa! Aconteceu algum problema!";
                }
            );
        } else {
            $http.put('/uab-commerce/services.php/' + entidade, objeto).then(
                function (response) {
                    $scope.sucesso = true;
                    $scope.mensagem = "Registro alterado com sucesso!";
                    $scope.cliente = {};
                    obter(entidade);
                },
                function (response) {
                    cliente = response.data;
                    $scope.erro = true;
                    $scope.mensagem = "Oooopa! Aconteceu algum problema!";
                }
            );
        }
    }
    obter(entidade);

});


app.controller('contactController', function ($scope) {
    $scope.message = 'Contact us! JK. This is just a demo.';
});

app.controller('mainController', function ($http, $scope, $rootScope, $window, $location) {
    $scope.cliente = {};
    $rootScope.loggedUser = JSON.parse($window.localStorage.getItem('user'));

    $scope.logout = function () {
        //console.log('entrou');
        $http.delete('/uab-commerce/services.php/session').then(
            function (response) {
                $window.localStorage.removeItem('user');
                delete $rootScope.loggedUser;
                $location.path('/uab-commerce/');
            },
            function (response) {
                alert('Não deu certo: ' + response.status + ' - ' + response.statusText);
            }
        );
    }

    $scope.login = function (objeto) {
        $http.post('/uab-commerce/services.php/session', objeto).then(
            function (response) {
                $window.localStorage.setItem('user', JSON.stringify(response.data));
                $rootScope.loggedUser = response.data;
                //$rootScope.user = response.data;
                $location.path('/uab-commerce/');
            },
            function (response) {
                alert('Não logou: ' + response.status + ' - ' + response.statusText);
            }
        );
    }

    $scope.addCliente = function (objeto) {
        $http.post('/uab-commerce/services.php/cliente', objeto).then(
            function (response) {
                $scope.sucesso = true;
                $scope.mensagem = "Registro cadastrado com sucesso!";
                $scope.objeto = {};
                obter(entidade);
            },
            function (response) {
                $scope.objeto = response.data;
                $scope.erro = true;
                $scope.mensagem = "Oooopa! Aconteceu algum problema!";
            }
        );
    }

});