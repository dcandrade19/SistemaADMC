<?php error_reporting(0);?>
<?php require_once '../config.php';?>
<?php include 'header.php';?>
<?php include_once '../model/condominio.php';?>
<?php include_once '../model/bloco.php';?>

<?php 

$controller = $_GET[controller];
if(!$controller) $controller = 'condominios';

if($controller =='condominios'){
    include '../controller/condominios.php';
    
}elseif($controller =='blocos'){
    include '../controller/blocos.php';
}
?>
<div class="container">
<form id="form" method="post" class="form">
<h2 class="titulo"><?php $titulo = ucfirst($controller); echo $titulo; ?></h2>
<div class="busca form-inline justify-content-end">

    <input class="form-control mr-sm-2" type="search" placeholder="Buscar" name="filtro" aria-label="Search">
    <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Buscar</button>
 </div>
<input id="controller" type="hidden" name="controller" value="<?php echo $controller ?>">
<input id="action" type="hidden" name="action" value="filtrar">
 


<hr>

  <div class="row justify-content-start">
    <div class="col-xs-12 text-center">
      <div class="btn-menu">
<i class="fas fa-plus fa-3x"></i>
<p>Adicionar <?php echo $controller ?></p>
</div>

  </div>  
  	 <?=$cond?> 
  </div>
  </div>

</form>
</div>
<?php include 'footer.php';?>