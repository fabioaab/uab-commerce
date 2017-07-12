(function(){
    var app = angular.module("produto", [ ]);
    
    app.controller('CadastroProdutoController', ['$http', function($http){
        var controller = this;
       
        this.listar = function(){
            $http.get('/uab-commerce/produtos').then(function(response){
                controller.produtos = response.data;
            });
        }

        this.excluir = function (produto){
            $http.delete('/uab-commerce/produto/' + produto.id).then(function(response){
                controller.produtos = response.data;
            });
        }

         this.escolher = function (produto){
            $http.get('/uab-commerce/produto/' + produto.id).then(function(response){
                controller.produto = response.data;                
            });
        }

         this.salvar = function (produto){
            var resultado = this;

            if(!produto.id){
                $http.post('/uab-commerce/produto', produto).then(
                    function(response){
                        resultado.sucesso = true;
                        resultado.mensagem = "Registro cadastrado com sucesso!";
                        //resultado.produto = {};
                        controller.listar();  
                    },
                    function(response){
                        produto = response.data;
                        resultado.erro = true;
                        resultado.mensagem = "Oooopa! Aconteceu algum problema!";
                    }
                );
            } else {
                $http.put('/uab-commerce/produto', produto).then(
                    function(response){
                        resultado.sucesso = true;
                        resultado.mensagem = "Registro alterado com sucesso!";
                        //resultado.produto = {};
                        controller.listar();  
                    },
                    function(response){
                        produto = response.data;
                        resultado.erro = true;
                        resultado.mensagem = "Oooopa! Aconteceu algum problema!";
                    }
                );
            }
                      
        }


         controller.listar();

    }]);
})();

