<?php
//criaзгo da classe
	class Sql extends PDO{ //a CLASSE EXTENDE DA CLASSE PDO. Tudo que o PDO jб faz, essa classe jб sabe fazer. Tem acesso as info
		private $conn;  //definindo a variбvel de conexгo como private.
		
		//conexгo automбtica com o banco de dados apуs a instaciaзгo (new)
		public function __construct(){
			$this->conn = new PDO("mysql:host=localhost;dbname=capitulo9", "root", "");
		}

		private function setParams($statement, $parameters = array()){
			foreach ($parameters as $key => $value){
				$this->setParam($statement, $key, $value);
			}
		}
		
		private function setParam($statement, $key, $value){
			$statement->bindParam($key, $value);
		}
		
		//execuзгo de comandos
		public function query($rawQuery, $params = array()){  
			$stmt = $this->conn->prepare($rawQuery); 
			$this->setParams($stmt, $params);
			$stmt->execute();
			return $stmt;
		}
		
		public function select($rawQuery, $params = array()){   //:array
			$stmt = $this->query($rawQuery, $params);
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
	}
?>