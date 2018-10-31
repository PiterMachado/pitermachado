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
$post = new Post($con);

$data = json_decode(file_get_contents('php://input'), true);
$post->id = $data['id'];
$post->titulo = $data['titulo'];
$post->texto = $data['texto'];
$post->autor = $data['autor'];
$post->id_categoria = $data['id_categoria'];

if ($post->update()){
	$res = array('status', 'ok');
}else{
	$res = array('status', 'falha na alteracao');
}

echo json_encode($res);