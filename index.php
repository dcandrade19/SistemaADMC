<?php error_reporting(0);?>
<?php require_once 'config.php';?>
<?php include (HEADER_TEMPLATE)?>
<?php
	//error_reporting(0); // para o caso de server gratuito.
?>

<?php
	include_once "./model/condominio.php";
	include_once "./model/morador.php";
	include_once "./model/usuario.php";
	include_once "./model/bloco.php";
	include_once "./model/apartamento.php";
	//include_once "./model/apartamento.php";

	if($_GET['action']=='sair'){
	    $_SESSION = '';
	    session_destroy();
	    $logged = 0;
	    header('Location: ' .BASEURL);
	}
	
	$logged = $_SESSION['logado'];
    echo 'logado:' .$_SESSION['logado'] .'?';
	if(!$logged){
		include './controller/login.php';

	}else{
		//include "/view/menu.php";
		if (!empty($_GET['controller'])) {
		    $controller = $_GET['controller'];
		}	
		if(!$controller) $controller = $_POST['controller'];
		if(!$controller || $controller=='login') $controller='condominios';	

		if($controller =='condominios'){
			include './controller/condominios.php';

		}elseif($controller =='usuarios'){
			include './controller/usuarios.php';

		}elseif($controller =='blocos'){
			include './controller/blocos.php';
		}
		elseif($controller =='apartamentos'){
		    include './controller/apartamentos.php';
		}
		elseif($controller =='moradores'){
		    include './controller/moradores.php';
		}
	}
    
	

?>
<?php include ('view/modal_' .$controller .'.php');?>
<?php include ('view/modal_view_' .$controller .'.php');?>
<?php include 'view/modal_confirmar.php';?>
<?php include (FOOTER_TEMPLATE)?>