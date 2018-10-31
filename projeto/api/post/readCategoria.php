<?php

header('Content-Type: application/json');

require_once '../../config/Conexao.php';
require_once '../../models/Post.php';

$db = new Conexao();

$con = $db->getConexao();

$post = new Post($con);

$id = json_decode(file_get_contents('php://input'),true);

$post->readCategoria($id);