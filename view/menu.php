<?php error_reporting(0);?>
<?php require_once '../config.php';?>
<?php include 'header.php';?>
<?php include_once '../model/condominio.php';?>
<?php include '../controller/condominios.php';?>

<div class="container">

<form method="post" class="form">
<div class="busca form-inline justify-content-end">
    <input class="form-control mr-sm-2" type="search" placeholder="Buscar" name="filtro" aria-label="Search">
    <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Buscar</button>
 </div>
<input type="hidden" name="controller" value="condominios">
<input type="hidden" name="action" value="filtrar">
 
<div class="btn-group btn-group-toggle" data-toggle="buttons">
  <label class="btn btn-secondary active">
    <input type="radio" name="options" id="option1" autocomplete="off" checked> Condominios
  </label>
  <label class="btn btn-secondary">
    <input type="radio" name="options" id="option2" autocomplete="off"> Ativos
  </label>
  <label class="btn btn-secondary">
    <input type="radio" name="options" id="option3" autocomplete="off"> Desativados
  </label>
</div>

<hr>

  <div class="row justify-content-start">
    <div class="col-xs-12 text-center">
      <div class="btn-menu">
<i class="fas fa-plus fa-3x"></i>
<p>Novo Condominio</p>
</div>
    </div>
   <?=$cond?> 
  </div>


<input type="hidden" name="controller" value="condominios">
<input type="hidden" name="action" value="filtrar"> 
<div class="btn-group btn-group-toggle" data-toggle="buttons">
  <label class="btn btn-secondary active">
    <input type="radio" name="options" id="option1" autocomplete="off" checked> Blocos
  </label>
  <label class="btn btn-secondary">
    <input type="radio" name="options" id="option2" autocomplete="off"> Funcionarios
  </label>
  <label class="btn btn-secondary">
    <input type="radio" name="options" id="option3" autocomplete="off"> Avisos
  </label>
  <label class="btn btn-secondary">
    <input type="radio" name="options" id="option4" autocomplete="off"> Despesas
  </label>
  <label class="btn btn-secondary">
    <input type="radio" name="options" id="option5" autocomplete="off"> Funções
  </label>
</div>

<hr>

  <div class="row justify-content-start">
    <div class="col-xs-12 text-center">
      <div class="btn-menu">
<i class="fas fa-plus fa-3x"></i>
<p>Novo Bloco</p>
</div>
    </div>
    <div class="col-xs-12 text-center">
      <div class="btn-menu">
<i class="fas fa-th-large fa-3x"></i>
<p>Azul</p>
<div class="mi-btn">
<a href="#" title="Detalhes"><i class="fas fa-eye"></i></a>
<a href="#" title="Editar"><i class="fas fa-edit"></i></a>
<a href="#" title="Excluir"><i class="fas fa-trash-alt"></i></a>
</div>
</div>
    </div>
    <div class="col-xs-12 text-center">
     <div class="btn-menu">
<i class="fas fa-th-large fa-3x"></i>
<p>Amarelo</p>
<div class="mi-btn">
<a href="#" title="Detalhes"><i class="fas fa-eye"></i></a>
<a href="#" title="Editar"><i class="fas fa-edit"></i></a>
<a href="#" title="Excluir"><i class="fas fa-trash-alt"></i></a>
</div>
</div>
    </div>
  </div>
  

<input type="hidden" name="controller" value="condominios">
<input type="hidden" name="action" value="filtrar"> 
<div class="btn-group btn-group-toggle" data-toggle="buttons">
  <label class="btn btn-secondary active">
    <input type="radio" name="options" id="option1" autocomplete="off" checked> Apartamentos
  </label>
  <label class="btn btn-secondary">
    <input type="radio" name="options" id="option2" autocomplete="off"> Ocupados
  </label>
  <label class="btn btn-secondary">
    <input type="radio" name="options" id="option3" autocomplete="off"> Vazios
  </label>
</div>

<hr>
  <div class="row justify-content-start">
    <div class="col-xs-12 text-center">
      <div class="btn-menu">
<i class="fas fa-plus fa-3x"></i>
<p>Novo Apartamento</p>
</div>
    </div>
    <div class="col-xs-12 text-center">
      <div class="btn-menu">
<i class="fas fa-key fa-3x"></i>
<p>01</p>
<div class="mi-btn">
<a href="#" title="Detalhes"><i class="fas fa-eye"></i></a>
<a href="#" title="Editar"><i class="fas fa-edit"></i></a>
<a href="#" title="Excluir"><i class="fas fa-trash-alt"></i></a>
</div>
</div>
    </div>
    <div class="col-xs-12 text-center">
     <div class="btn-menu">
<i class="fas fa-key fa-3x"></i>
<p>02</p>
<div class="mi-btn">
<a href="#" title="Detalhes"><i class="fas fa-eye"></i></a>
<a href="#" title="Editar"><i class="fas fa-edit"></i></a>
<a href="#" title="Excluir"><i class="fas fa-trash-alt"></i></a>
</div>
</div>
    </div>
  </div>
  

<input type="hidden" name="controller" value="condominios">
<input type="hidden" name="action" value="filtrar"> 
<div class="btn-group btn-group-toggle" data-toggle="buttons">
  <label class="btn btn-secondary active">
    <input type="radio" name="options" id="option1" autocomplete="off" checked>Moradores
  </label>
</div>

<hr>
  <div class="row justify-content-start">
    <div class="col-xs-12 text-center">
      <div class="btn-menu">
<i class="fas fa-plus fa-3x"></i>
<p>Novo Morador</p>
</div>
    </div>
    <div class="col-xs-12 text-center">
      <div class="btn-menu">
<i class="far fa-user fa-3x"></i>
<p>João</p>
<div class="mi-btn">
<a href="#" title="Detalhes"><i class="fas fa-eye"></i></a>
<a href="#" title="Editar"><i class="fas fa-edit"></i></a>
<a href="#" title="Excluir"><i class="fas fa-trash-alt"></i></a>
</div>
</div>
    </div>
    <div class="col-xs-12 text-center">
     <div class="btn-menu">
<i class="far fa-user fa-3x"></i>
<p>Manoel</p>
<div class="mi-btn">
<a href="#" title="Detalhes"><i class="fas fa-eye"></i></a>
<a href="#" title="Editar"><i class="fas fa-edit"></i></a>
<a href="#" title="Excluir"><i class="fas fa-trash-alt"></i></a>
</div>
</div>
    </div>
  </div>
  

<input type="hidden" name="controller" value="condominios">
<input type="hidden" name="action" value="filtrar"> 
<div class="btn-group btn-group-toggle" data-toggle="buttons">
  <label class="btn btn-secondary active">
    <input type="radio" name="options" id="option1" autocomplete="off" checked>Serviços
  </label>
</div>
</form> 
<hr>
  <div class="row justify-content-start">
    <div class="col-xs-12 text-center">
      <div class="btn-menu">
<i class="fas fa-plus fa-3x"></i>
<p>Novo Serviço</p>
</div>
    </div>
    <div class="col-xs-12 text-center">
      <div class="btn-menu">
<i class="fas fa-wrench fa-3x"></i>
<p>Instalação...</p>
<div class="mi-btn">
<a href="#" title="Detalhes"><i class="fas fa-eye"></i></a>
<a href="#" title="Editar"><i class="fas fa-edit"></i></a>
<a href="#" title="Excluir"><i class="fas fa-trash-alt"></i></a>
</div>
</div>
    </div>
    <div class="col-xs-12 text-center">
     <div class="btn-menu">
<i class="fas fa-wrench fa-3x"></i>
<p>...Manutenção</p>
<div class="mi-btn">
<a href="#" title="Detalhes"><i class="fas fa-eye"></i></a>
<a href="#" title="Editar"><i class="fas fa-edit"></i></a>
<a href="#" title="Excluir"><i class="fas fa-trash-alt"></i></a>
</div>
</div>
    </div>
  </div>
</div>
<?php include 'footer.php';?>