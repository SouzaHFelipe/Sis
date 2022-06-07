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

<script type="text/javascript">

		document.editar.reset();
		editar.nome.reser();
	
		function valida(){

			var nome = editar.nome.value;
			var email = editar.email.value;
			var senha = editar.senha.value;
			var tipo = editar.tipo.value;
			
			if(nome == "") {
				alert("Preencha o nome");
				editar.nome.focus();
				return false;
			} else  if (email == "") {
				alert("Preencha o email");
				editar.email.focus();
				return false;
			} else  if (senha == "") {
				alert("Preencha a senha");
				editar.senha.focus();
				return false;
			}
			if (tipo != "admin" && tipo != "comum" {
					alert("Tipo inv·lido");
					editar.tipo.focus();
					return false;
			}
}
</script>

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
			$usuario-> setusuId($linha['usuId']);
			$usuario-> setusuNome($linha['usuNome']);
			$usuario-> setusuEmail($linha['usuEmail']);
			$usuario-> setusuSenha($linha['usuSenha']);
			$usuario-> setusuTipo($linha['usuTipo']);
		}
	}
}

if ( isset($_POST['voltar']) and ($_POST['voltar'] == 'Retornar')) {
	header('Location: admin.php');
}

if ( isset($_POST['salvar']) and ($_POST['salvar'] == 'Salvar')) {

	if( !empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['senha']) ) {
		$usuario-> setusuId($_POST['id']);
		$usuario-> setusuNome($_POST['nome']);
		$usuario-> setusuEmail($_POST['email']);
		$usuario-> setusuSenha($_POST['senha']);
		$usuario-> setusuTipo($_POST['tipo']);
		
		$usuarioDAO = new UsuarioDAO();
		
		$resultado = $usuarioDAO-> alteraUsuario($usuario->getusuId(), $usuario->getusuNome(), $usuario->getusuEmail(),
		$usuario->getusuSenha(), $usuario->getusuTipo());
	}
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
				<form id="editar" name="editar" method="post">

					<div class="form-group">
					<input type="hidden" name="id" id="id" value=<?php echo $usuario->getusuId();?> >
					</div>
					
					<div class="form-group">
						<label>Nome: </label>
						 <input type="text" class="form-control" 
							name="nome" id="nome" value=<?php echo $usuario->getusuNome(); ?> >
					</div>

					<div class="form-group">
						<label>E-mail: </label> <input type="email" class="form-control"
							name="email" id="email"
							value=<?php echo $usuario->getusuEmail(); ?>>
					</div>

					<div class="form-group">
						<label>Senha: </label> <input type="password" class="form-control"
							name="senha" id="senha"
							value=<?php echo $usuario->getusuSenha(); ?>>
					</div>

					<div class="form-group">
						<label>Tipo: </label> <input type="text" class="form-control"
							name="tipo" id="tipo" value=<?php echo $usuario->getusuTipo(); ?>>
					</div>

					<button type="submit" class="btn btn-success" name="salvar"
						value="Salvar" onclick="valida()">Salvar</button>

					<input type="submit" class="btn btn-info" name="voltar"
						value="Retornar">
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
