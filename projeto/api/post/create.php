<?php

header('Content-Type: application/json');

require_once '../../config/Conexao.php';
require_once '../../models/Post.php';

//instancia o objeto conexao
$db = new Conexao();

//recebe a conexao feita
$con = $db->getConexao();


//instancia o objeto categotia com a conexao como parametro
//passa a conexao
$data = json_decode(file_get_contents('php://input'), true);

$post = new Post($con);
$post->titulo = $data['titulo'];
$post->texto = $data['texto'];
$post->id_categoria = $data['id_categoria'];
$post->autor = $data['autor'];

if ($post->create()){
	http_response_code(201);
	echo json_encode(['mensagem'=>'Post criado']);
}else{
	echo json_encode(['mensagem'=>'Post não foi criado']);
}

