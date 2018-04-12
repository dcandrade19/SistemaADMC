<?php

	if($_POST[login]!=''){
		$usuario = usuario::search($_POST[login]);
		
		if($_POST[senha] == $usuario->getSenha()){
				$_SESSION['logado'] = 1;
				$_SESSION['login'] = $usuario->getLogin();
				$_SESSION['nivel'] = $usuario->getNivel();
				$_SESSION['id'] = $usuario->getId();
				$logged = 1;
			}
		}
	
	if(!$logged){
		include "./view/login.php";
	}

?>