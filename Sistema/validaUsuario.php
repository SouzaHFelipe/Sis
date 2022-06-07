<?php
	if (isset($_COOKIE['usuEmail'])) {
		$usuEmail = $_COOKIE['usuEmail'];
	}
	if (isset($_COOKIE['usuSenha'])) {
		$usuSenha = $_COOKIE['usuSenha'];
	}

	if (isset($_COOKIE['usuTipo'])){
		$usuTipo = $_COOKIE['usuTipo'];
	}
	
	if ( !(empty($usuEmail)) and !(empty($usuSenha)) ) {
		
		$usuarioDAO = new UsuarioDAO();
		$resultado = $usuarioDAO-> buscaEmail($usuEmail);
		if ( count($resultado) == 0) {
			?>
				<script type="text/javascript">
					alert("Email n�o cadastrado");
				</script>
			<?php
			header('Location: index.php');
		} else {
			foreach($resultado as $linha) {
				$usuSenhaBD = $linha['usuSenha'];
				$usuTipoBD = $linha['usuTipo'];
			}
			// verifica se a senha informada � igual a senha cadastrado.
			if ($usuSenha != $usuSenhaBD) {
				?>
					<script type="text/javascript">
						alert("Senha n�o confere");
					</script>
				<?php
				header('Location: index.php');
			} 		
		}
	} else {
		?>
			<script type="text/javascript">
				alert("Voc� n�o realizou o login");
			</script>
		<?php
		header('Location: index.php');
	}
?>