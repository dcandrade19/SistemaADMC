<div class="modal fade bd-example-modal-sm" tabindex="-1" id="modal_funcionarios" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg  modal-dialog-centered">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Novo Funcionario:</h5>
    </div>
      <div class="modal-body">
      <div class="container-fluid">
          <form action="./?controller=funcionarios&action=createupdate"  method="post">
  
  <div class="row ">  
    <div class="form-group col-md-4">
      <label for="name">Nome: </label>
      <input type="text" class="form-control" name="nome" value="<?=$nome?>" required>
    </div>

    <div class="form-group col-md-6">
      <label for="campo2">CPF: </label>
      <input type="text" class="form-control cpf"  id="cpfc" name="cpf" value="<?=$cpf?>" onchange="validarCPF(this.value)" required>
    </div>

    <div class="form-group col-md-2">
      <label for="campo2">Status: </label>
      <select class="custom-select" name="status" value="<?=$status?>">
        <option value="1" <?php echo $status=='1'?'selected':'';?>>Ativado</option>
        <option value="0" <?php echo $status=='0'?'selected':'';?>>Desativado</option>
      </select>
    </div>
    </div>
     <div class="row ">  
    <div class="form-group col-md-4">
      <label for="condominio">Condomínio: </label>
        <?php echo apartamento::doSelectCondominio();?>
    </div>


    <div class="form-group col-md-4"> 
      <label for="bloco">Função</label>
      <div id="funcao">
      <select disabled class="form-control">
      <option selected >Nenhum condominio selecionado!</option>
      </select>
    </div>
</div>

  
    <div class="form-group col-md-3">
      <label for="valor">Salario: </label>
      <input type="text" id="moeda" class="form-control" name="valor" value="<?=$valor?>" required>
    </div>
</div>
  	<input hidden="true" name="id" value="<?=$id?>">

	<input type="hidden" name="controller" value="funcionarios">
	<input type="hidden" name="action" value="createupdate">
</div>
      </div>
      <div class="modal-footer">   
        <button type="button" data-dismiss="modal" class="btn btn-light">Cancelar</button>
        <button type="submit" name="enviar" class="btn btn-info">Salvar</button>
      </div>
     </form>
    </div>
  </div>
</div>
<script type="text/javascript">
function fetch_select(val){
         $.ajax({
             type: 'post',
             url: 'view/fetch_data.php',
             data: {
              id_condominio: val
             },
             success: function (response) {
                document.getElementById("bloco").innerHTML=response;
             }
         });
}
function fetch_select_apt(val){
    $.ajax({
        type: 'post',
        url: 'view/fetch_data.php',
        data: {
         id_bloco: val
        },
        success: function (response) {
           document.getElementById("apartamento").innerHTML=response;
        }
    });
}
    function validarCPF(cpf){ 
    	$.ajax({
            type: 'post',
            url: 'view/fetch_data.php',
            data: {
             cpf: cpf
            },
            success: function (response) {
            	if(!response){
                	alert('CPF inválido!');
                	
                	document.getElementById("cpfc").value='';  
            	}
            }
        });
}
</script>