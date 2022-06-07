<?php
	require_once ("\class\usuario.class.php");
	require_once ("\dao\usuarioDAO.class.php");
	require_once ("validaUsuario.php");
	$usuarioDAO = new UsuarioDAO();
	$usuarios = $usuarioDAO-> listaUsuario();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>FormulÃ¡rio</title>

<!-- Bootstrap -->
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<script>

	function excluir(id) {


		
		var apagar = confirm('Você deseja excluir este usuário?');
	    if (apagar){
	        location.href = 'deletar.php?id='+ id;
	   	}   
	}
</script>
</head>
<body>
	<div class="container">

	<header>
		<div class="row">
			<div class="col-sm-6">
				<h2>Administração de Usuários</h2>
			</div>
			<div class="col-sm-6 text-right h2">
		    	<a class="btn btn-default" href="index.php"><i class="fa fa-refresh"></i>Home</a>
		    	<a class="btn btn-default" href="logout.php"><i class="fa fa-refresh"></i>Sair</a>
		    </div>
		</div>
	</header>	
		<table class="table table-hover">
			<thead>
				<tr>
					<th>ID</th>
					<th width="40%">Nome</th>
					<th>email</th>
					<th>senha</th>
					<th>tipo</th>
					<th>Opções</th>
				</tr>
			</thead>
			<tbody>
				<?php if ($usuarios) {
					foreach ($usuarios as $usuario) {
					?><tr>
						<td id="usuId"><?php echo $usuario['usuId']; ?></td>
						<td><?php echo $usuario['usuNome']; ?></td>
						<td><?php echo $usuario['usuEmail']; ?></td>
						<td><?php echo $usuario['usuSenha']; ?></td>
						<td><?php echo $usuario['usuTipo']; ?></td>
						<td class="actions text-right">
							<a href="consultar.php?id=<?php echo $usuario['usuId']; ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> Visualizar</a>
							<a href="editar.php?id=<?php echo $usuario['usuId']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Editar</a>


							<a href="#" id="Excluir" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-modal" data-customer="<?php echo $usuario['usuId']; ?>" onclick="excluir(<?php echo $usuario['usuId']; ?>)">
								<i class="fa fa-trash"></i> Excluir
							</a>
						</td>
					<?php } 
				
				} else {
					?>
					<tr>
						<td colspan="6">Nenhum registro encontrado.</td>
					</tr>
					<?php }	?>
			</tbody>
		</table>
	</div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
