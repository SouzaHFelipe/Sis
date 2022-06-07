<?php
	require_once ("\class\usuario.class.php");
	require_once ("\dao\usuarioDAO.class.php");
	require_once ("validaUsuario.php");
	
	if ( isset($_GET['id']) and ($_GET['id'] != "")) {
	
		// recebe os dados do formulário
		$id = $_GET['id'];
	
		// instancia o usuarioDAO para fazer conexão e comandos relacionados ao BD
		$usuarioDAO = new UsuarioDAO();
		// Pesquisa se o email informado existe.
		$resultado = $usuarioDAO-> excluiUsuario($id);
		header('Location: admin.php');
	}
?>