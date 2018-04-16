<div class="modal fade bd-example-modal-sm" tabindex="-1" id="modal_condominios" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg  modal-dialog-centered">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Novo Condominio:</h5>
    </div>
      <div class="modal-body">
      <div class="container-fluid">
          <form action="./?controller=condominios&action=createupdate" method="post">
  
  <div class="row ">  
    <div class="form-group col-md-4">
      <label for="name">Nome: </label>
      <input type="text" class="form-control" name="nome" value="<?=$nome?>" required>
    </div>

    <div class="form-group col-md-6">
      <label for="campo2">Endereço: </label>
      <input type="text" class="form-control" name="endereco" value="<?=$endereco?>" required>
    </div>

    <div class="form-group col-md-2">
      <label for="campo2">Status: </label>
      <select class="custom-select" name="status" value="<?=$status?>">
        <option value="0">Desativado</option>
        <option value="1">Ativado</option>
      </select>
    </div>
  </div>
  	<input type="hidden" name="id" value="<?=$id?>">
	<input type="hidden" name="controller" value="condominios">
	<input type="hidden" name="action" value="createupdate">
</div>
      </div>
      <div class="modal-footer">   
        <button type="button" data-dismiss="modal" class="btn btn-light">Cancelar</button>
        <input type="submit" name="enviar" class="btn btn-info" value="Salvar"></input>
      </div>
     </form>
    </div>
  </div>
</div>