<?php

class Categoria{
	public $id;
	public $nome;
	public $descricao;
	private $conexao;

	public function __construct($con){
		$this->conexao = $con;
	}

	public function read($id=null){
		if (isset($id)){
			$consulta = "SELECT * from categoria where id=:id";
			$stmt = $this->conexao->prepare($consulta);
			$stmt->bindParam(':id',$id,PDO::PARAM_INT);

		}else{
			$consulta = "SELECT nome, id from categoria order by nome";
			$stmt = $this->conexao->prepare($consulta);
			$stmt->execute();
			$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $resultado;
		}

		$stmt->execute();
		$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
		return $resultado;
	}

	public function readCategoria($id){
		$consulta = "SELECT * from post p INNER JOIN categoria c ON c.id = p.id WHERE p.id = :id";
		$stmt = $this->conexao->prepare($consulta);
		$stmt->bindParam(':id',$id,PDO::PARAM_INT);
		$stmt->execute();
		$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
		return $resultado;
	}

	public function create(){
		$consulta = "INSERT INTO categoria(id,nome,descricao) VALUES(0, :nome,:descricao)";
		$stmt = $this->conexao->prepare($consulta);
		$stmt->bindParam(':nome', $this->nome , PDO::PARAM_STR);
		$stmt->bindParam(':descricao', $this->descricao, PDO::PARAM_STR);
		if ($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	public function update($data){
		$consulta = "UPDATE categoria SET nome = :nome, descricao = :descricao WHERE id = :id;";
		$stmt = $this->conexao->prepare($consulta);
		$stmt->bindParam(':id', $data['id'] , PDO::PARAM_INT);
		$stmt->bindParam(':nome', $data['nome'] , PDO::PARAM_STR);
		$stmt->bindParam(':descricao', $data['descricao'], PDO::PARAM_STR);
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

	public function delete($data){
		$consulta = "DELETE FROM categoria WHERE id = :id";
		$stmt = $this->conexao->prepare($consulta);
		$stmt->bindParam(':id', $data['id'] , PDO::PARAM_INT);
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