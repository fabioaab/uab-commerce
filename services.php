<?php

require 'vendor/autoload.php';
require 'config/constants.php';
require 'config/config.php';

$app = new \Slim\App(["settings" => $config]);

$container = $app->getContainer();

$container['db'] = function ($c) {
    $db = $c['settings']['db'];
    $pdo = new PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['dbname'],
        $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};


$app->get('/cliente/{id}', function ($request, $response) {
    return obterRegistro($this, $request, 'CLIENTE');
});

$app->get('/carrinho/{id}', function ($request, $response) {
    return obterRegistro($this, $request, 'CARRINHO');
});

$app->get('/produto/{id}', function ($request, $response) {
    return obterRegistro($this, $request, 'PRODUTO');
});

$app->get('/pagamento/{id}', function ($request, $response) {
    return obterRegistro($this, $request, 'PAGAMENTO');
});

$app->get('/clientes', function ($request, $response) {
    return obterRegistros($this, $request, 'CLIENTE');
});

$app->get('/carrinhos', function ($request, $response) {
    return obterRegistros($this, $request, 'CARRINHO');
});

$app->get('/produtos', function ($request, $response) {
    return obterRegistros($this, $request, 'PRODUTO');
});

$app->get('/pagamentos', function ($request, $response) {
    return obterRegistros($this, $request, 'PAGAMENTO');
});

$app->post('/cliente', function ($request, $response) {
    $input = $request->getParsedBody();
    $tmp = $this->db->prepare("INSERT INTO CLIENTE (nome, email, password, telefone) VALUES (:nome, :email, :password, :telefone)");
    $tmp->bindParam("nome", $input["nome"]);
    $tmp->bindParam("email", $input["email"]);
    $tmp->bindParam("password", $input["password"]);
    $tmp->bindParam("telefone", $input["telefone"]);
    $tmp->execute();
    $input["id"] = $this->db->lastInsertId();
    $input["sucesso"] = $this->db->lastInsertId();
    return $this->response->withJson($input);
});

$app->post('/session', function ($request, $response) {
    $input = $request->getParsedBody();
    $tmp = $this->db->prepare("SELECT * FROM cliente WHERE email = :email and password = :password");
    $tmp->bindParam("email", $input["email"]);
    $tmp->bindParam("password", $input["password"]);
    $tmp->execute();
    $registro = $tmp->fetch();
    
    if ( ! session_id() ) session_start();
    if ( ! isset($_SESSION['user'])) $_SESSION['user'] = $registro;
    
    return $this->response->withJson($registro);
});

$app->delete('/session', function ($request, $response) {
    if ( ! session_id() ) session_start();
    if ( isset($_SESSION['user'])) session_destroy();
    
    return $this->response;
});

$app->post('/produto', function ($request, $response) {
    $input = $request->getParsedBody();
    $tmp = $this->db->prepare("INSERT INTO PRODUTO (nome, descricao, valor, quantidade, unidade, imagem) VALUES (:nome, :descricao, :valor, :quantidade, :unidade, :imagem)");
    $tmp->bindParam("nome", $input["nome"]);
    $tmp->bindParam("descricao", $input["descricao"]);
    $tmp->bindParam("valor", $input["valor"]);
    $tmp->bindParam("quantidade", $input["quantidade"]);
    $tmp->bindParam("unidade", $input["unidade"]);
    $tmp->bindParam("imagem", $input["imagem"]);
    $tmp->execute();
    $input["id"] = $this->db->lastInsertId();
    return $this->response->withJson($input);
});

$app->post('/carrinho', function ($request, $response) {
    $input = $request->getParsedBody();
    $tmp = $this->db->prepare("INSERT INTO CARRINHO (id_usuario, id_produto, quantidade, valor, data_inclusao) VALUES (:id_usuario, :id_produto, :quantidade, :valor, :data_inclusao)");
    $tmp->bindParam("id_usuario", $input["id_usuario"]);
    $tmp->bindParam("id_produto", $input["id_produto"]);
    $tmp->bindParam("quantidade", $input["quantidade"]);
    $tmp->bindParam("valor", $input["valor"]);
    $tmp->bindParam("data_inclusao", $input["data_inclusao"]);
    $tmp->execute();
    $input["id"] = $this->db->lastInsertId();
    return $this->response->withJson($input);
});

$app->post('/pagamento', function ($request, $response) {
    $input = $request->getParsedBody();
    $tmp = $this->db->prepare("INSERT INTO PAGAMENTO (id_carrinho, id_cliente, soma_carrinho, taxa_servico, valor_total, quantidade_itens, data_pagamento) VALUES (:id_carrinho, :id_cliente, :soma_carrinho, :taxa_servico, :valor_total, :quantidade_itens, :data_pagamento)");
    $tmp->bindParam("id_carrinho", $input["id_carrinho"]);
    $tmp->bindParam("id_cliente", $input["id_cliente"]);
    $tmp->bindParam("soma_carrinho", $input["soma_carrinho"]);
    $tmp->bindParam("taxa_servico", $input["taxa_servico"]);
    $tmp->bindParam("valor_total", $input["valor_total"]);
    $tmp->bindParam("quantidade_itens", $input["quantidade_itens"]);
    $tmp->bindParam("data_pagamento", $input["data_pagamento"]);
    $tmp->execute();
    $input["id"] = $this->db->lastInsertId();
    return $this->response->withJson($input);
});


$app->put('/cliente', function ($request, $response) {
    $input = $request->getParsedBody();
    $tmp = $this->db->prepare("UPDATE CLIENTE SET nome=:nome, email=:email, password=:password, telefone=:telefone WHERE id=:id");
    $tmp->bindParam("nome", $input["nome"]);
    $tmp->bindParam("email", $input["email"]);
    $tmp->bindParam("password", $input["password"]);
    $tmp->bindParam("telefone", $input["telefone"]);
    $tmp->bindParam("id", $input["id"]);
    $tmp->execute();
    $input["id"] = $this->db->lastInsertId();
    return $this->response->withJson($input);
});

$app->put('/produto', function ($request, $response) {
    $input = $request->getParsedBody();
    $tmp = $this->db->prepare("UPDATE PRODUTO set nome=:nome, descricao=:descricao, valor=:valor, quantidade=:quantidade, unidade=:unidade, imagem=:imagem WHERE id=:id");
    $tmp->bindParam("nome", $input["nome"]);
    $tmp->bindParam("descricao", $input["descricao"]);
    $tmp->bindParam("valor", $input["valor"]);
    $tmp->bindParam("quantidade", $input["quantidade"]);
    $tmp->bindParam("unidade", $input["unidade"]);
    $tmp->bindParam("imagem", $input["imagem"]);
    $tmp->bindParam("id", $input["id"]);
    $tmp->execute();
    $input["id"] = $this->db->lastInsertId();
    return $this->response->withJson($input);
});

$app->put('/carrinho', function ($request, $response) {
    $input = $request->getParsedBody();
    $tmp = $this->db->prepare("UPDATE CARRINHO SET id_usuario=:id_usuario, id_produto=:id_produto, quantidade=:quantidade, valor=:valor, data_inclusao:=data_inclusao WHERE id=:id");
    $tmp->bindParam("id_usuario", $input["id_usuario"]);
    $tmp->bindParam("id_produto", $input["id_produto"]);
    $tmp->bindParam("quantidade", $input["quantidade"]);
    $tmp->bindParam("valor", $input["valor"]);
    $tmp->bindParam("data_inclusao", $input["data_inclusao"]);
    $tmp->bindParam("id", $input["id"]);
    $tmp->execute();
    $input["id"] = $this->db->lastInsertId();
    return $this->response->withJson($input);
});

$app->put('/pagamento', function ($request, $response) {
    $input = $request->getParsedBody();
    $tmp = $this->db->prepare("UPDATE PAGAMENTO SET id_carrinho:=id_carrinho, id_cliente:=id_cliente, soma_carrinho:=soma_carrinho, taxa_servico:=taxa_servico, valor_total:=valor_total, quantidade_itens:=quantidade_itens, data_pagamento:=data_pagamento WHERE id=:id");
    $tmp->bindParam("id_carrinho", $input["id_carrinho"]);
    $tmp->bindParam("id_cliente", $input["id_cliente"]);
    $tmp->bindParam("soma_carrinho", $input["soma_carrinho"]);
    $tmp->bindParam("taxa_servico", $input["taxa_servico"]);
    $tmp->bindParam("valor_total", $input["valor_total"]);
    $tmp->bindParam("quantidade_itens", $input["quantidade_itens"]);
    $tmp->bindParam("data_pagamento", $input["data_pagamento"]);
    $tmp->bindParam("id", $input["id"]);
    $tmp->execute();
    $input["id"] = $this->db->lastInsertId();
    return $this->response->withJson($input);
});

$app->delete('/cliente/{id}', function ($request, $response) {
    return excluirRegistro($this, $request, $response, 'CLIENTE');
    
});

$app->delete('/produto/{id}', function ($request, $response) {
    return excluirRegistro($this, $request, $response, 'PRODUTO');
});

$app->delete('/carrinho/{id}', function ($request, $response) {
    return excluirRegistro($this, $request, $response, 'CARRINHO');
});

$app->delete('/pagamento/{id}', function ($request, $response) {
    return excluirRegistro($this, $request, $response, 'PAGAMENTO');
});

function excluirRegistro($container, $request, $response, $entidade){
    $id = $request->getAttribute('id');
    $tmp = $container->db->prepare("DELETE FROM $entidade WHERE id=:id");
    $tmp->bindParam("id", $id);
    $tmp->execute();

    return obterRegistros($container, $request, $entidade);
}

function obterRegistro($container, $request, $entidade){
    $id = $request->getAttribute('id');
    $tmp = $container->db->prepare("SELECT * FROM $entidade WHERE id = :id");
    $tmp->bindParam("id", $id);
    $tmp->execute();
    $registros = $tmp->fetch();
    return $container->response->withJson($registros);
}

function obterRegistros($container, $request, $entidade){
    $tmp = $container->db->prepare("SELECT * FROM $entidade ");
    $tmp->execute();
    $registros = $tmp->fetchAll();
    return $container->response->withJson($registros);
}


$app->run();
