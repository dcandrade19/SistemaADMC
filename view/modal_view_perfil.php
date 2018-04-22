
<!-- Large modal -->

<div class="modal fade " tabindex="-1" id="modal_view_perfil" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      <div class="modal-body">
      <div class="col col-md-12">
      <i class="fas fa-user fa-3x"></i>
      <div class="view-head col-md-8">
      
      <h3><?=$nome?></h3>
      
      <div class="view-dados">
      
      <div  id="head-dados"><?=$morador_tipo?> | <?=$status?></div>
      
      
      </div>
      
      </div>
      </div>
      
      <hr>
      
      <h5 class="view-titulo">Dados</h5>
      <form>
      <div class="row ">  
    <div class="form-group col-md-6">
      <label for="name">Nome: </label>
      <input type="text" class="form-control" name="nome" value="<?=$nome?>" required>
    </div>

    <div class="form-group col-md-6">
      <label for="campo2">CPF: </label>
      <input type="text" class="form-control" id="cpf" name="cpf" value="<?=$cpf?>" onchange="validarCPF(this.value)" disabled>
    </div>
     </div>
      
     <div class="row ">  
      <div class="form-group col-md-5">
      <label for="condominio">Condominio: </label>
      <input type="text" class="form-control" name="condominio" value="<?=$morador_condominio?>" disabled>
      </div>
      
      <div class="form-group col-md-3">
      <label for="bloco">Bloco: </label>
      <input type="text" class="form-control" name="bloco" value="<?=$morador_bloco?>" disabled>
      </div>
      
      <div class="form-group col-md-2">
      <label for="apartamento">Apartamento: </label>
      <input type="text" class="form-control"  name="apartamento" value="<?=$morador_apt?>" disabled>
      </div>
    </div>
      <hr> 
        <div class="row ">  
    <div class="form-group col-md-6">
      <label for="login">Usuario: </label>
      <input type="text" class="form-control" name="login" value="<?=$morador_usuario?>" disabled>
    </div>

    <div class="form-group col-md-6">
      <label for="senha">Senha: </label>
      <input type="password" class="form-control" name="senha" placeholder="******" value="">
    </div>
     </div>
       </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary">Salvar alterações</button>
      </div>
    </div>
  </div>
</div>
