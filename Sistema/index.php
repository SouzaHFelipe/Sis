<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
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
	
		function valida(){
			
			var nome = document.getElementById('nome').value;
			var email = document.getElementById('email').value;
			var senha = document.getElementById('senha').value;
			
			if(nome == "") {
				alert("Preencha o nome");
				cadastro.nome.focus();
				return false;
			} else  if (email == "") {
				alert("Preencha o email");
				cadastro.email.focus();
				return false;
			} else  if (senha == "") {
				alert("Preencha a senha");
				cadastro.senha.focus();
				return false;
			}

		}

		function validaLogin(){

			var emailLogin = login.emailLogin.value;
			var senhaLogin = login.senhaLogin.value;
			
			if(emailLogin == "") {
				alert("Preencha o email de login");
				login.emailLogin.focus();
				return false;
			} else  if (senhaLogin == "") {
				alert("Preencha a senha de login");
				login.senhaLogin.focus();
				return false;
			}

		}
	</script>

<?php
require_once ("\class\usuario.class.php");
require_once ("\dao\usuarioDAO.class.php");

if ( isset($_POST['salvar']) and ($_POST['salvar'] == 'Salvar')) {

	if( !empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['senha']) ) {
		//Tipo de usu·rio: 0 - admin, 1 - comum
		$usuario = new Usuario();
		$usuario-> setusuNome($_POST['nome']);
		$usuario-> setusuEmail($_POST['email']);
		$usuario-> setusuSenha($_POST['senha']);
		$usuario-> setusuTipo("comum");
		$usuarioDAO = new UsuarioDAO();
		$resultado = $usuarioDAO-> buscaEmail($usuario->getusuEmail());
		if ( count($resultado) > 0) {
			?>
				<script type="text/javascript">
					alert("Email j· cadastrado");
					cadastro.email.focus();
				</script>
			<?php
		} else {
			$results = $usuarioDAO-> insereUsuario($usuario-> getusuNome(), $usuario-> getusuEmail(), $usuario-> getusuSenha(), $usuario-> getusuTipo());
		}
	}
}

if ( isset($_POST['logar']) and ($_POST['logar'] == 'Acessar')) {

	if( !empty($_POST['emailLogin']) && !empty($_POST['senhaLogin']) ) {

		// recebe os dados do formul·rio
		$usuEmail = $_POST['emailLogin'];
		$usuSenha = $_POST['senhaLogin'];
		
		// instancia um usu·rio
		$usuario = new Usuario();
		
		// instancia o usuarioDAO para fazer conex„o e comandos relacionados ao BD
		$usuarioDAO = new UsuarioDAO();
		// Pesquisa se o email informado existe.
		$resultado = $usuarioDAO-> buscaEmail($usuEmail);
		
		// Testa se o email informado existe. Se for igual 0, significa que n„o h· email cadastrado.
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

			// verifica se a senha informada È igual a senha cadastrado.
			if ($usuario -> getusuSenha() != $usuSenha) {
				?>
					<script type="text/javascript">
						alert("Senha n„o confere");
						login.email.focus();
					</script>
				<?php
			} else { // redireciona o usu·rio de acordo com o seu perfil cadastrado.
				setcookie('usuEmail',$usuEmail);
				setcookie('usuSenha',$usuSenha);
				
				if ($usuario->getusuTipo()== "admin") {
						setcookie('usuTipo','admin');
						header('Location: admin.php');
				} else {
					setcookie('usuTipo','comum');
					header('Location: logado.php');
				}
			}

		}
	}
}


?>

</head>
<body>
	<div class="container">
		<div class="page-header">
			<h1>Gerenciamento de Usu·rios</h1>
		</div>
		<div class="row">
			<div class="col-sm-8">
				<!-- Configura√ß√£o para tablets. Ocupar√° 8 colunas. -->
				<h3>Registre-se</h3>
				<h5>N√£o √© usu√°rio?</h5>
				<form name="cadastro" method="post">
					<div class="form-group">
						<label>Nome: </label> <input type="text" class="form-control"
							name="nome" id="nome">
						<!-- classe de formata√ß√£o do Bootstrap -->
					</div>

					<div class="form-group">
						<label>E-mail: </label> <input type="email" class="form-control"
							name="email" id="email">
					</div>

					<div class="form-group">
						<label>Senha: </label> <input type="password" class="form-control"
							name="senha" id="senha">
					</div>

					<div class="checkbox">
						<label> <input type="checkbox"> Aceito os termos do servi√ßo. </label>
					</div>

					<button type="submit" class="btn btn-primary" name="salvar"
						value="Salvar" onclick="valida()">Salvar</button>
				</form>
			</div>

			<div class="col-sm-4">
				<!-- Ocupar√° 4 colunas. Totalizando 12 colunas (8+4) -->
				<h3>Login</h3>
				<h5>(Apenas usu√°rios cadastrados)</h5>
				<form id="login" name="login" method="post">
					<div class="form-group">
						<input type="email" name="emailLogin" class="form-control"
							placeholder="Digite seu e-mail.">
					</div>

					<div class="form-group">
						<input type="password" name="senhaLogin" class="form-control"
							placeholder="Digite sua senha.">
					</div>

					<input type="submit" class="btn btn-primary" name="logar" value="Acessar" onclick="validaLogin()">
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
