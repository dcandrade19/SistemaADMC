<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="<?php echo BASEURL; ?>_support/bootstrap/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo BASEURL; ?>_support/bootstrap/js/jquery.mask.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo BASEURL;?>_support/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo BASEURL;?>css/style.css">
    
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-start" id="navbarTogglerDemo01">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item active">
    <a class="navbar-brand" href="<?php echo BASEURL;?>">Sistema ADMC</a>
    </li>
    <li class="nav-item">
    <a href="?controller=condominios" class="nav-link">Condominios</a>
    </li>
    <li class="nav-item">
    <a href="?controller=blocos" class="nav-link">Blocos</a>
    </li>
    <li class="nav-item">
    <a href="?controller=apartamentos" class="nav-link">Apartamentos</a>
    </li>
    <li class="nav-item">
    <a href="?controller=moradores" class="nav-link">Moradores</a>
    </li>
    <li class="nav-item">
    <a href="?controller=funcionarios" class="nav-link disabled">Funcionarios</a>
    </li>
    <li class="nav-item">
    <a href="?controller=avisos" class="nav-link disabled">Avisos</a>
    </li>
    <li class="nav-item">
    <a href="?controller=servicos" class="nav-link disabled">Serviços</a>
    </li>
    <li class="nav-item">
    <a href="?controller=despesas" class="nav-link disabled">Despesas</a>
    </li>
    <li class="nav-item">
    <a href="?controller=funcoes" class="nav-link disabled">Funções</a>
    </li>
 </ul>
  </div>
  <div class="justify-content-end" id="navbarTogglerDemo01">
	<?php if (!empty($_SESSION['logado'])){
	    $texto = '<i class="fas fa-user-circle"></i> ' .$_SESSION['login'];
	    echo ' 
     <div class="btn-group fix-btn-group">
     <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
     '.$texto .'
     </button>
     <div class="dropdown-menu dropdown-menu-right">
     <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal_log"><span class="drop-opc"><i class="fas fa-list"></i> Log </span></a>
     <a class="dropdown-item" href="#" data-toggle="modal" data-target="#confirm"><span class="sair"><i class="fas fa-sign-in-alt"></i> Sair </span></a>
     
     </div>
     </div>';
	} else {
	    $link = BASEURL;
	    $texto = '<i class="fas fa-sign-in-alt"></i> ' .'Entrar';
	    echo '<a href="'.$link .'" class="btn btn-secondary btn-sm">'.$texto .'</a>';
	}
    
 ?>
   </div>
</nav>

<header>

</header>
