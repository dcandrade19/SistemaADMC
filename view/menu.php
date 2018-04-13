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
 
<div class="btn-group btn-group-toggle">

    <a href="?controller=condominios" class="btn btn-outline-dark btn-sm" >Condominios</a>
    <a href="?controller=blocos" class="btn btn-outline-dark btn-sm">Blocos</a>
    <a href="?controller=apartamentos" class="btn btn-outline-dark btn-sm">Apartamentos</a>
    <a href="?controller=moradores" class="btn btn-outline-dark btn-sm">Moradores</a>
    <a href="?controller=funcionarios" class="btn btn-outline-dark btn-sm">Funcionarios</a>
    <a href="?controller=avisos" class="btn btn-outline-dark btn-sm">Avisos</a>
    <a href="?controller=servicos" class="btn btn-outline-dark btn-sm">Serviços</a>
    <a href="?controller=despesas" class="btn btn-outline-dark btn-sm">Despesas</a>
    <a href="?controller=funcoes" class="btn btn-outline-dark btn-sm">Funções</a>

</div>

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