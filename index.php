<?php error_reporting(0);?>
<?php date_default_timezone_set('America/Sao_Paulo');?>
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
	include_once "./model/funcionario.php";
	//include_once "./model/apartamento.php";

	if($_GET['action']=='sair'){
	    $_SESSION = '';
	    session_destroy();
	    $logged = 0;
	    header('Location: ' .BASEURL);
	}
	
	$logged = $_SESSION['logado'];

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
		}elseif($controller =='blocos'){
			include './controller/blocos.php';
		}
		elseif($controller =='apartamentos'){
		    include './controller/apartamentos.php';
		}
		elseif($controller =='moradores'){
		    include './controller/moradores.php';
		}
		elseif($controller =='funcionarios'){
		    include './controller/funcionarios.php';
		}
	}
    
	

?>
<?php include ('view/modal_view_perfil.php');?>
<?php include 'view/modal_confirmar.php';?>
<?php include 'view/modal_log.php';?>
<?php include ('view/modal_' .$controller .'.php');?>
<?php include ('view/modal_view_condominios.php');?>
<?php include (FOOTER_TEMPLATE)?>