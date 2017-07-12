<!DOCTYPE html>
<html ng-app="app" ng-controller="mainController" lang="pt">
<?php session_start(); ?>

<head>
  <title>UAB-Commerce</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <base href="/">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="/uab-commerce/css/custom.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="/uab-commerce/bower_components/angular/angular.min.js"></script>
  <script type="text/javascript" src="/uab-commerce/bower_components/angular-route/angular-route.min.js"></script>
  <script type="text/javascript" src="/uab-commerce/js/app.js"></script>
</head>
<body >
    <header>
        <nav class="navbar navbar-inverse" >
            <div class="container-fluid">
                <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
                </button>
                <a class="navbar-brand" href="/uab-commerce/">UAB-Commerce</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar" >
                <ul class="nav navbar-nav">
                <li class="active"><a href="/uab-commerce/">Home</a></li>
                
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administração <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="/uab-commerce/administracao/cliente">Clientes</a></li>
                    <li><a href="/uab-commerce/administracao/produto">Produtos</a></li>
                    <li><a href="#">Pagamentos</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="/uab-commerce/menu" ng-click="menu.logout()">Sair</a></li>
                </ul>
                </li>
                <li><a href="#">Minhas compras</a></li>
                
                </ul>
                <ul class="nav navbar-nav navbar-right">
                
                <li><a href ng-show="loggedUser"><span class="glyphicon glyphicon-shopping-cart"></span> Carrinho</a></li>
                <li><a href ng-show="loggedUser"><span class="glyphicon glyphicon-user"></span> {{loggedUser.nome}}</a></li>
                <li><a href ng-show="loggedUser" ng-click="logout()"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                <li><a href="/uab-commerce/login" ng-show="!loggedUser"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                <li><a href="/uab-commerce/signin"  ng-show="!loggedUser"><span class="glyphicon glyphicon-map-marker"></span> Signin</a></li>
                
                </ul>
            </div>
            </div>
        </nav>
    </header>
    <div id="main">
        {{message}}
        <div ng-view></div>
    </div>

    <footer class="container-fluid text-center">
    <p>Footer Text</p>
    </footer>

</body>
</html>