<?php
if(!empty($_POST['login'])){
		$usuario = usuario::search($_POST['login']);
		if($usuario) {
		    if(password_verify($_POST['senha'], $usuario->getSenha())){
		        if ($usuario->getStatus()) {
		            $_SESSION['logado'] = 1;
		            $_SESSION['login'] = $usuario->getLogin();
		            $_SESSION['nivel'] = $usuario->getNivel();
		            $_SESSION['id'] = $usuario->getId();
		            $logged = 1;
		            header('Location: ' .BASEURL);
		        } else {
		            $res = '<div class="alert alert-secondary entrar-div alert-dismissible fade show" role="alert">
    Usuario desativado!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>';
		        } 
		    } else {
		        $res = '<div class="alert alert-secondary entrar-div alert-dismissible fade show" role="alert">
    Senha errada!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>';
		    }
		} else {
		    $res = '<div class="alert alert-secondary entrar-div alert-dismissible fade show" role="alert">
    Usuario não encontrado!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>';
		}
		}
		
		
	if(!$logged){
		include "./view/login.php";
	}

?>