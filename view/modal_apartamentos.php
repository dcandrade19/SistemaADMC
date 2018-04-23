<div class="modal fade bd-example-modal-sm" tabindex="-1" id="modal_apartamentos" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg  modal-dialog-centered">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Novo Apartamento:</h5>
    </div>
      <div class="modal-body">
      <div class="container-fluid">
          <form action="./?controller=apartamentos&action=createupdate"  method="post">
  
  <div class="row ">  
    <div class="form-group col-md-4">
      <label for="name">Numero: </label>
      <input type="number" class="form-control" name="numero" value="<?=$numero?>" min="1" required>
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
    <div class="form-group col-md-6">
      <label for="condominio">Condomínio: </label>
        <?php echo apartamento::doSelectCondominio();?>
    </div>


    <div class="form-group col-md-6"> 
      <label for="bloco">Bloco</label>
      <div id="bloco">
      <select disabled class="form-control">
      <option selected >Nenhum condominio selecionado!</option>
      </select>
    </div>

    
  </div>
  	<input hidden="true" name="id" value="<?=$id?>">
	<input type="hidden" name="controller" value="apartamentos">
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
</script>