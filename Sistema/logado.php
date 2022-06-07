<?php
	require_once ("\class\usuario.class.php");
	require_once ("\dao\usuarioDAO.class.php");
	require_once ("validaUsuario.php");
?>
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

</head>
<body>
	<div class="container">
		<header>
			<div class="row">
				<div class="col-sm-6">
					<h2>Usu·rio logado no sistema</h2>
				</div>
				<div class="col-sm-6 text-right h2">
		    	<a class="btn btn-default" href="index.php"><i class="fa fa-refresh"></i>Home</a>
		    	<a class="btn btn-default" href="logout.php"><i class="fa fa-refresh"></i>Sair</a>
			    </div>
			</div>
		</header>	
	</div>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>