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
		            $resu = '<div class="invalid-tooltip">
                    Usuário desativado!
                    </div>';   
		        } 
		    } else {
		        $res = '<div class="invalid-tooltip">
                    Senha errada!
                    </div>';  
		    }
		} else {    
		    $resu = '<div class="invalid-tooltip">
                    Usuário não encontrado!
                    </div>';
		}
		}
		
		
	if(!$logged){
		include "./view/login.php";
	}

?>