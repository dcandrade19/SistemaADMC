<div class="login-bg">
<form class="mx-auto login p-4"  method="post" action="./?controller=login&action=logar">
  <div class="form-group">
    <label for="exampleDropdownFormEmail2">Usuario</label>
    <input type="text" name="login" class="form-control" id="exampleDropdownFormEmail2" placeholder="Usuario">
  </div>
  <div class="form-group">
    <label for="exampleDropdownFormPassword2">Senha</label>
    <input type="password" name="senha" class="form-control" id="exampleDropdownFormPassword2" placeholder="******">
  </div>
  <div class="form-group entrar">
  <button id="entrar" type="submit" class="btn btn-secondary">Entrar</button>
  <?=$res?>
  </div>
</form>
</div>
