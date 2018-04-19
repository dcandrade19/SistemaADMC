<div class="container">
<form id="form" method="post" class="form"  <?php echo 'action="./?controller=' .$controller .'&action=filtrar"' ?> >
<h2 class="titulo"><?php $titulo = ucfirst($controller); echo $titulo; ?></h2>
<div class="busca form-inline">
	<input type="hidden" name="controller" value="<?php $controller?>">
	<input type="hidden" name="action" value="filtrar">
	<button class="btn btn-secondary my-2 my-sm-0 btn-atualizar" type="submit"><i class="fas fa-sync-alt"></i> Atualizar</button>
	<div>

    <input class="form-control mr-sm-2" type="search" placeholder="Buscar" name="filtro" onchange="this.form.submit()" aria-label="Search">
    <button class="btn btn-secondary my-2 my-sm-0" type="submit"><i class="fas fa-search"></i> Buscar</button>
    </div>
 </div>

<hr>
<?=$res?>
  <div class="row justify-content-start">
    <div class="col-xs-12 text-center">
    <?php echo '<div id="btn-novo" class="btn-menu">' ?>   
<i class="fas fa-plus fa-3x"></i>
<p>Adicionar <?php echo $controller ?></p>
</div>

  </div>  

	<?=$tb?>
	
  </form>
  </div>

  <script>
$(document).ready(function(){

	$('#cpf').mask('000.000.000-00');

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
