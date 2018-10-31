<?php

class Post{
	public $id;
	public $titulo;
	public $texto;
	public $id_categoria;
	public $autor;
	public $dt_criacao;
	private $conexao;

	public function __construct($con){
		$this->conexao = $con;

	}

	public function read(){
		$consulta = "SELECT texto,titulo,id,id_categoria from post ";
		$stmt = $this->conexao->prepare($consulta);
		$stmt->execute();
		$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
		die(json_encode($resultado));
	}

	public function readCategoria($id){
		$consulta = "SELECT c.id,p.id,p.titulo,c.nome,p.autor,p.autor,p.texto,p.id_categoria from post p INNER JOIN categoria c ON c.id = p.id_categoria WHERE c.id = ?";
		$stmt = $this->conexao->prepare($consulta);
		$stmt->bindParam(1,$id['id']);
		$stmt->execute();
		$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
		die(json_encode($resultado));
	}

	public function create(){
		$consulta = "INSERT INTO post(titulo,texto,autor,id_categoria) VALUES( :titulo,:texto,:autor,:id_categoria)";
		$stmt = $this->conexao->prepare($consulta);
		$stmt->bindParam(':titulo', $this->titulo , PDO::PARAM_STR);
		$stmt->bindParam(':texto', $this->texto , PDO::PARAM_STR);
		$stmt->bindParam(':autor', $this->autor , PDO::PARAM_STR);
		$stmt->bindParam(':id_categoria', $this->id_categoria, PDO::PARAM_INT);
		if ($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	public function update(){
		$consulta = "UPDATE post SET titulo = :titulo, texto = :texto, autor = :autor, id_categoria = :id_categoria WHERE id = :id;";
		$stmt = $this->conexao->prepare($consulta);
		$stmt->bindParam(':id', $this->id , PDO::PARAM_INT);
		$stmt->bindParam(':titulo', $this->titulo , PDO::PARAM_STR);
		$stmt->bindParam(':texto', $this->texto , PDO::PARAM_STR);
		$stmt->bindParam(':autor', $this->autor , PDO::PARAM_INT);
		$stmt->bindParam(':id_categoria', $this->id_categoria, PDO::PARAM_INT);
		try {
			$stmt->execute();
			if($stmt->rowCount() > 0){
				return true;
			}else{
				return false;
			}
		}catch(PDOException $e){
			echo $e->getMessage();
			return false;
		}
	}

	public function delete(){
		$consulta = "DELETE FROM post WHERE id = :id";
		$stmt = $this->conexao->prepare($consulta);
		$stmt->bindParam(':id', $this->id , PDO::PARAM_INT);
		try {
			$stmt->execute();
			if($stmt->rowCount() > 0){
				return true;
			}else{
				return false;
			}
		}catch(PDOException $e){
			echo $e->getMessage();
			return false;
		}
	}
}