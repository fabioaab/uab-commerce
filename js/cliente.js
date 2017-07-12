// js/session.js

(function(){
    var app = angular.module("cliente", ['session']);
    
    app.controller('ObterClienteController', ['$http', function($http){
        var clienteController = this;

        $http.get('/uab-commerce/cliente/1').then(function(response){
            clienteController.cliente = response.data;
            
        });
    }]);

    app.controller('RegistrarClienteController', ['$http', function($http){
        this.addCliente = function (cliente){
            var resultado = this;
            
            $http.post('/uab-commerce/cliente', cliente).then(
                function(response){
                    resultado.sucesso = true;
                    resultado.mensagem = "Obrigado por se cadastrar em nosso e-commerce!";
                    resultado.cliente = {};
                },
                function(response){
                    cliente = response.data;
                    resultado.erro = true;
                    resultado.mensagem = "Oooopa! Aconteceu algum problema!";
                }
            );
        }
    }]);


    app.controller('CadastroClienteController', ['$http', function($http){
        var clienteController = this;
       
        this.obterClientes = function(){
            $http.get('/uab-commerce/clientes').then(function(response){
                clienteController.clientes = response.data;
            });
        }

        this.excluirCliente = function (cliente){
            $http.delete('/uab-commerce/cliente/' + cliente.id).then(function(response){
                clienteController.clientes = response.data;
            });
        }

         this.escolherCliente = function (cliente){
            $http.get('/uab-commerce/cliente/' + cliente.id).then(function(response){
                clienteController.cliente = response.data;
                clienteController.obterClientes();
            });
        }

         this.salvarCliente = function (cliente){
            var resultado = this;

            if(!cliente.id){
                $http.post('/uab-commerce/cliente', cliente).then(
                    function(response){
                        resultado.sucesso = true;
                        resultado.mensagem = "Registro cadastrado com sucesso!";
                        resultado.cliente = {};
                    },
                    function(response){
                        cliente = response.data;
                        resultado.erro = true;
                        resultado.mensagem = "Oooopa! Aconteceu algum problema!";
                    }
                );
            } else {
                $http.put('/uab-commerce/cliente', cliente).then(
                    function(response){
                        resultado.sucesso = true;
                        resultado.mensagem = "Registro alterado com sucesso!";
                        resultado.cliente = {};
                    },
                    function(response){
                        cliente = response.data;
                        resultado.erro = true;
                        resultado.mensagem = "Oooopa! Aconteceu algum problema!";
                    }
                );
            }
            clienteController.obterClientes();
            
        }
         clienteController.obterClientes();

    }]);
})();

