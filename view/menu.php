<div class="container">
<form id="form" method="post" class="form"  <?php echo 'action="./?controller=' .$controller .'&action=filtrar"' ?> >
<h2 class="titulo"><?php $titulo = ucfirst($controller); echo $titulo; ?></h2>
<div class="busca form-inline">
	<input type="hidden" name="controller" value="<?php $controller?>">
	<input type="hidden" name="action" value="filtrar">
	
	<button class="btn btn-secondary my-2 my-sm-0 btn-atualizar" type="submit"><i class="fas fa-sync-alt"></i> Atualizar</button>
	
	<?php
$opcoes = array(
    'Todos',
    'Ativados',
    'Desativados'
);
$select_opcoes = $_POST['select_opcoes'] ;

$views = array(
    'Normal',
    'Alternativo',
);
$select_views = $_POST['select_views'];
?>
<div class="row">
	<div class="input-group mr-sm-2">
  <div class="input-group-prepend">
    <label class="input-group-text" for="select_opcoes"><i class="fas fa-filter"></i> &nbsp; Exibir</label>
  </div>
      <select class="custom-select" name="select_opcoes" onchange="this.form.submit()" id="select_opcoes">
        <?php foreach($opcoes as $opcao){ ?>
		<option value="<?php echo $opcao; ?>" <?php echo ($opcao==$select_opcoes) ?'selected="selected"':''; ?>><?php echo $opcao; ?></option>
		<?php } ?>
      </select>
      </div>
      <div class="input-group mr-sm-2">
  <div class="input-group-prepend">
  
    <label class="input-group-text" for="select_views"><i class="fas fa-eye"></i> &nbsp; Modo</label>
  </div>
       <select class="custom-select" name="select_views" onchange="this.form.submit()" id="select_views">
        <?php foreach($views as $view){ ?>
		<option value="<?php echo $view; ?>" <?php echo ($view==$select_views) ?'selected="selected"':''; ?>><?php echo $view; ?></option>
		<?php } ?>
      </select>
</div>

    <input class="form-control mr-sm-2" type="search" placeholder="Buscar" name="filtro" onchange="this.form.submit()" aria-label="Search">
    <button class="btn btn-secondary my-2 my-sm-0" type="submit"><i class="fas fa-search"></i> Buscar</button>
    </div>
</div>
<hr>
<?php if ($res){
    echo $res;
}elseif($resf) {
    echo $resf;
}?>
<?php 
if (!isset($_SESSION['log'])) {
    $_SESSION['log'] = array();
    $_SESSION['time'] = array();
}

if ($res) {
    
    $data = date("d/m/Y H:i:s");
    
    array_push( $_SESSION['log'] , $res);
    array_push( $_SESSION['time'] , $data);
       
}
?>
  <div class="row justify-content-start">
    <div class="col-xs-12 text-center">
    <?php echo '<div id="btn-novo" class="btn-menu">' ?>   
<i class="fas fa-plus fa-3x"></i>
<h5>Adicionar <?php echo $controller ?></h5>
</div>

  </div>  
	<?php if ($_POST['select_views']) {
	    if ($_POST['select_views'] == 'Normal') {
	        echo $tb;
	    } else {
	        echo $cond;
	    }
	} else {
	    echo $tb;
	}?>

  </form>
  </div>

  <script>
$(document).ready(function($){

	$('.cpf').mask('000.000.000-00');
	$('#moeda').mask('000,000.00' , {reverse: true});

	 $('[data-toggle="tooltip"]').tooltip();   
    $("#btn-novo").click(function(){	
    	$("#modal_<?php echo $controller?>").find('input[type!=hidden]').val('');
        $("#modal_<?php echo $controller?>").modal();       
    });
  
    $('body').on('click', '.disabled', function(e) {
        e.preventDefault();
        return false;
    });
});
</script>
 	</div> 