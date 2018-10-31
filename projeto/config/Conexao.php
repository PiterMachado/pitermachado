<?php
class Conexao{
	private $host = 'localhost';
	private $dbname = 'bancoblog';
	private $user = 'root';
	private $pass = '';
	private $conexao;

	public function getConexao(){
		$this->conexao = null;

		try{
			$this->conexao = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname,$this->user,$this->pass);
			$this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e){
			echo "Erro na conexão: ".$e->getMessage();
			throw new PDOException($e);
			
		}

		return $this->conexao;
	}
}
