<div class="modal fade bd-example-modal-sm" tabindex="-1" id="modal_moradores" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg  modal-dialog-centered">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Novo Morador:</h5>
    </div>
      <div class="modal-body">
      <div class="container-fluid">
          <form action="./?controller=moradores&action=createupdate"  method="post">
  
  <div class="row ">  
    <div class="form-group col-md-4">
      <label for="name">Nome: </label>
      <input type="text" class="form-control" id="nome" name="nome" value="<?=$nome?>" onchange="gerarusuario(this.value)" required>
    </div>

    <div class="form-group col-md-6">
      <label for="campo2">CPF: </label>
      <input type="text" class="form-control cpf"  id="cpfb" name="cpf" value="<?=$cpf?>"  onchange="validarCPF(this.value)" required>
      <div class="invalid-feedback">
        Por favor informe um CPF valido!
      </div>
      <div class="valid-feedback">
        CPF valido!
      </div>
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
      <label for="bloco">Bloco</label>
      <div id="bloco">
      <select disabled class="form-control">
      <option selected >Nenhum condominio selecionado!</option>
      </select>
    </div>
</div>

<div class="form-group col-md-4"> 
      <label for="apartamento">Apartamento</label>
      <div id="apartamento">
      <select disabled class="form-control">
      <option selected >Nenhum bloco selecionado!</option>
      </select>
    </div>
</div>
</div>

<div class="row ">  
    <div class="form-group col-md-4" data-toggle="tooltip" data-placement="bottom" title="Você pode alterar este campo ou manter o login gerado.">
      <label for="login">Usuario: </label>
      <input type="text"  id="login" class="form-control" name="login" value="<?=$login?>" required>
    </div>
    
    <div class="form-group col-md-3" data-toggle="tooltip" data-placement="bottom" title="Informe uma senha ou vazio para senha padrão.">
      <label for="senha">Senha: </label>
      <input type="password" class="form-control" name="senha" placeholder="*******" value="">
    </div>
    
    <div class="form-group col-md-3">
      <label for="nivel">Nivel: </label>
      <select class="custom-select" name="nivel" value="<?=$nivel?>" required>
        <option value="" selected disabled hidden>Selecione</option>
        <option value="2" <?php echo $nivel=='2'?'selected':'';?>>Morador</option>
        <option value="1" <?php echo $nivel=='1'?'selected':'';?>>Sindico</option>
        <option value="0" <?php echo $nivel=='0'?'selected':'';?>>Administrador</option>
      </select>
    </div>
    
    <div class="form-group col-md-2">
      <label for="usuario_status">Login: </label>
      <select class="custom-select" name="usuario_status" value="<?=$usuario_status?>">
        <option value="1" <?php echo $usuario_status=='1'?'selected':'';?>>Ativado</option>
        <option value="0" <?php echo $usuario_status=='0'?'selected':'';?>>Desativado</option>
      </select>
    </div>
    
</div>
  	<input hidden="true" name="id" value="<?=$id?>">
  	<input hidden="true" name="id_usuario" value="<?=$id_usuario?>">
	<input type="hidden" name="controller" value="moradores">
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
function validarCPF(cpf){ 
	$.ajax({
        type: 'post',
        url: 'view/fetch_data.php',
        data: {
         cpf: cpf
        },
        success: function (response) {
        	if(!response){
            	document.getElementById("cpfb").value=''; 
            	document.getElementById("cpfb").classList.remove("is-valid");
            	document.getElementById("cpfb").classList.add("is-invalid");
        	} else {
        		document.getElementById("cpfb").classList.remove("is-invalid");
        		document.getElementById("cpfb").classList.add("is-valid");
        	}
        }
    });
}
function gerarusuario(nome){ 
    	$.ajax({
            type: 'post',
            url: 'view/fetch_data.php',
            data: {
             login: nome
            },
            success: function (response) {
            document.getElementById("login").value=response;   
            }
        });
}

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
</script>