<?php
	require_once ("\class\usuario.class.php");
	require_once ("\dao\usuarioDAO.class.php");
	require_once ("validaUsuario.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>Formul√°rio</title>

<!-- Bootstrap -->
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<?php

if ( isset($_GET['id']) and ($_GET['id'] != "")) {

		// recebe os dados do formul·rio
		$id = $_GET['id'];
	
		// instancia um usu·rio
		$usuario = new Usuario();
		
		// instancia o usuarioDAO para fazer conex„o e comandos relacionados ao BD
		$usuarioDAO = new UsuarioDAO();
		// Pesquisa se o email informado existe.
		$resultado = $usuarioDAO-> consultaUsuario($id);
		
		if ( count($resultado) == 0) {
			?>
			<script type="text/javascript">
				alert("Email n„o cadastrado");
				login.email.focus();
			</script>
			<?php
		} else { // armazena o resultado do select no objeto usuario criado
			foreach($resultado as $linha) {
				$usuario-> setusuNome($linha['usuNome']);
				$usuario-> setusuEmail($linha['usuEmail']);
				$usuario-> setusuSenha($linha['usuSenha']);
				$usuario-> setusuTipo($linha['usuTipo']);
			}
		}
}

if ( isset($_POST['voltar']) and ($_POST['voltar'] == 'Voltar')) {
	header('Location: admin.php');
}

?>

</head>
<body>
	<div class="container">
		<header>
			<div class="row">
				<div class="col-sm-6">
					<h2>Dados do Usu·rio</h2>
				</div>
				<div class="col-sm-6 text-right h2">
		    	<a class="btn btn-default" href="index.php"><i class="fa fa-refresh"></i>Home</a>
		    	<a class="btn btn-default" href="logout.php"><i class="fa fa-refresh"></i>Sair</a>
			    </div>
			</div>
		</header>	
		
		<div class="row">
			<div class="col-sm-8">
				<!-- Configura√ß√£o para tablets. Ocupar√° 8 colunas. -->
				<form name="consulta" method="post">
					<div class="form-group">
						<label>Nome: </label> <input type="text" class="form-control"
							name="nome" id="nome" value=<?php echo $usuario->getusuNome(); ?> readonly>
						<!-- classe de formata√ß√£o do Bootstrap -->
					</div>

					<div class="form-group">
						<label>E-mail: </label> <input type="email" class="form-control"
							name="email" id="email" value=<?php echo $usuario->getusuEmail(); ?> readonly>
					</div>

					<div class="form-group">
						<label>Senha: </label> <input type="password" class="form-control"
							name="senha" id="senha"  value=<?php echo $usuario->getusuSenha(); ?> readonly>
					</div>
					
					<div class="form-group">
						<label>Tipo: </label> <input type="text" class="form-control"
							name="tipo" id="tipo"  value=<?php echo $usuario->getusuTipo(); ?> readonly>
					</div>

					<button type="submit" class="btn btn-primary" name="voltar"
						value="Voltar">Retornar</button>
				</form>
			</div>

		</div>

	</div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
