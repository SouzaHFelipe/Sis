<?php
require_once ("\dao\sql.php");

class UsuarioDAO extends Sql {

	//consulta de todos os registros
	public function listaUsuario(){
		$sql = new Sql();
		$resultado = $sql -> select ("SELECT * FROM usuario ORDER BY usuNome;");
		return $resultado;
	}

	//inclusão do usuario
	public function insereUsuario($usuNome, $usuEmail, $usuSenha, $usuTipo){
		
		$sql = new Sql();

		$resultado = $sql -> query("INSERT INTO usuario (usuNome, usuEmail, usuSenha, usuTipo)
										VALUES (:NOME, :EMAIL, :SENHA, :TIPO)", 
		array(":NOME"=>$usuNome, ":EMAIL"=>$usuEmail ,":SENHA"=>$usuSenha, ":TIPO"=>$usuTipo));
		return ($resultado);
	}

	//Excluir usuario
	public function excluiUsuario($id){
		$sql = new Sql();

		$resultado = $sql -> query("DELETE FROM usuario WHERE usuId = :ID",
		array(":ID"=>$id));
		return ($resultado);
	}

	//alatera usuario
	public function alteraUsuario($usuId, $usuNome, $usuEmail, $usuSenha, $usuTipo){
		$sql = new Sql();

		$resultado = $sql -> query("UPDATE usuario
										SET usuNome = :NOME, 
										usuEmail = :EMAIL,
										usuSenha = :SENHA,
										usuTipo = :TIPO 
										WHERE usuId = :ID", 
		array(":NOME"=>$usuNome, ":EMAIL"=>$usuEmail, ":SENHA"=>$usuSenha, ":TIPO"=>$usuTipo, ":ID"=>$usuId));
		return ($resultado);
	}

	//Consulta usuario especifico
	public function consultaUsuario($id){
		$sql = new Sql(); 
		$results = $sql->select("SELECT * FROM usuario WHERE usuId = :ID", array(":ID"=>$id));
		return $results;
	}

	public function buscaEmail($email){
		$sql = new Sql(); 
		$results = $sql->select("SELECT * FROM usuario WHERE usuEmail = :EMAIL", array(":EMAIL"=>$email));
		return $results;
	}

}
?>