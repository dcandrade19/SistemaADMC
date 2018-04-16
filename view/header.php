<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
     <script src="<?php echo BASEURL; ?>_support/bootstrap/js/jquery-3.3.1.min.js"></script>
	<link rel="stylesheet" href="<?php echo BASEURL;?>_support/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo BASEURL;?>css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" >
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-start" id="navbarTogglerDemo01">
    <a class="navbar-brand" href="<?php echo BASEURL;?>">Sistema ADMC</a>
    <a href="?controller=condominios" class="nav-link">Condominios</a>
    <a href="?controller=blocos" class="nav-link">Blocos</a>
    <a href="?controller=apartamentos" class="nav-link">Apartamentos</a>
    <a href="?controller=moradores" class="nav-link">Moradores</a>
    <a href="?controller=funcionarios" class="nav-link">Funcionarios</a>
    <a href="?controller=avisos" class="nav-link">Avisos</a>
    <a href="?controller=servicos" class="nav-link">Serviços</a>
    <a href="?controller=despesas" class="nav-link">Despesas</a>
    <a href="?controller=funcoes" class="nav-link">Funções</a>
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
     <a class="dropdown-item" href="#" data-toggle="modal" data-target="#confirm"><span class="sair">Sair <i class="fas fa-sign-in-alt"></i></span></a>
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

</body>
 
</html>