<?php
if(!empty($_POST['login'])){
		$usuario = usuario::search($_POST['login']);
		if($usuario) {
		    if(password_verify($_POST['senha'], $usuario->getSenha())){
		        echo 'passou';
		        $_SESSION['logado'] = 1;
		        $_SESSION['login'] = $usuario->getLogin();
		        $_SESSION['nivel'] = $usuario->getNivel();
		        $_SESSION['id'] = $usuario->getId();
		        $logged = 1;
		        header('Location: ' .BASEURL);
		    }
		}
		}
		
		
	if(!$logged){
		include "./view/login.php";
	}

?>