<?php

header('Content-Type: application/json');

require_once '../../config/Conexao.php';
require_once '../../models/Categoria.php';

$db = new Conexao();

$con = $db->getConexao();

$cat = new Categoria($con);

$resultado = $cat->read();

echo json_encode($resultado);