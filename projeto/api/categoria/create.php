<?php

header('Content-Type: application/json');

require_once '../../config/Conexao.php';
require_once '../../models/Categoria.php';

$db = new Conexao();

$con = $db->getConexao();

$data = json_decode(file_get_contents('php://input'), true);

$cat = new Categoria($con);
$cat->nome = $data['nome'];
$cat->descricao = $data['descricao'];
if ($cat->create()){
	http_response_code(201);
	echo json_encode(['mensagem'=>'Categoria criada']);
}else{
	echo json_encode(['mensagem'=>'Categoria não foi criada']);
}

