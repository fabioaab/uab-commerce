(function () {
    var app = angular.module("session", []);

    app.controller('SessionController', ['$http', function ($http) {
        var controller = this;
        controller.erro = false;
        //controller.session = {};

        this.signin = function (form) {
            $http.post('/uab-commerce/session', form).then(
                function (response) {
                    controller.session = response.data;
                    document.location = '/uab-commerce/index2.php';
                },
                function (response) {
                    alert('Não logou: ' + response.status + ' - ' + response.statusText);
                }
            );
        }

        this.logout = function () {
            $http.delete('/uab-commerce/session').then(
                function (response) {
                    document.location = '/uab-commerce/index2.php';
                },
                function (response) {
                    alert('Não deu certo: ' + response.status + ' - ' + response.statusText);
                }
            );
        }

    }]);
})();

