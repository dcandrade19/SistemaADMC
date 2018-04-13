<?php require_once 'config.php';?>
<?php include 'view/header.php';?>
<div class="login-bg">
<form class="mx-auto login p-4">
  <div class="form-group">
    <label for="exampleDropdownFormEmail2">Usuario</label>
    <input type="text" class="form-control" id="exampleDropdownFormEmail2" placeholder="Usuario">
  </div>
  <div class="form-group">
    <label for="exampleDropdownFormPassword2">Senha</label>
    <input type="password" class="form-control" id="exampleDropdownFormPassword2" placeholder="******">
  </div>
  <div class="form-check">
    <input type="checkbox" class="form-check-input" id="dropdownCheck2">
    <label class="form-check-label" for="dropdownCheck2">
      Lembre-se de mim
    </label>
  </div>
  <button type="submit" class="btn btn-secondary">Entrar</button>
</form>
</div>
<?php include 'view/footer.php';?>