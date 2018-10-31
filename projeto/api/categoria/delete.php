<?php

header('Content-Type: application/json');

require_once '../../config/Conexao.php';
require_once '../../models/Categoria.php';

$db = new Conexao();

$con = $db->getConexao();

$cat = new Categoria($con);

$data = json_decode(file_get_contents('php://input'), true);

if ($cat->delete($data)){
	$res = array('status', 'ok');
}else{
	$res = array('status', 'falha na alteracao');
}

echo json_encode($res);