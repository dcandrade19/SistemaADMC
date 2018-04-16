<<<<<<< HEAD
/**
 * Passa os dados do cliente para o Modal, e atualiza o link para exclusão
 */
$('#delete-modal').on('show.bs.modal', function (event) {
  
  var button = $(event.relatedTarget);
  var id = button.data('object');
  var classe = button.data('classe');
  
  var modal = $(this);
  
  switch(classe){
  	case "funcionario":
  		modal.find('.modal-title').text('Excluir Funcionário #' + id);
  		modal.find('#confirm').attr('href', 'deletarFuncionario.php?id=' + id);
  		break;
  	case "apartamento":
  		modal.find('.modal-title').text('Excluir Apartamento #' + id);
  		modal.find('#confirm').attr('href', 'deletarApartamento.php?id=' + id);
  		break;
  	case "condominio":
  		modal.find('.modal-title').text('Excluir Condomínio #' + id);
  		modal.find('#confirm').attr('href', 'deletarCondominio.php?id=' + id);
  		break;
  	case "morador":
  		modal.find('.modal-title').text('Excluir Morador #' + id);
  		modal.find('#confirm').attr('href', 'deletarMorador.php?id=' + id);
  		break;
  	case "aviso":
  		modal.find('.modal-title').text('Excluir Aviso #' + id);
  		modal.find('#confirm').attr('href', 'deletarAviso.php?id=' + id);
  		break;
  }
  
=======
/**
 * Passa os dados do cliente para o Modal, e atualiza o link para exclusão
 */
$('#delete-modal').on('show.bs.modal', function (event) {
  
  var button = $(event.relatedTarget);
  var id = button.data('object');
  var classe = button.data('classe');
  
  var modal = $(this);
  
  switch(classe){
  	case "funcionario":
  		modal.find('.modal-title').text('Excluir Funcionário #' + id);
  		modal.find('#confirm').attr('href', 'deletarFuncionario.php?id=' + id);
  		break;
  	case "apartamento":
  		modal.find('.modal-title').text('Excluir Apartamento #' + id);
  		modal.find('#confirm').attr('href', 'deletarApartamento.php?id=' + id);
  		break;
  	case "condominio":
  		modal.find('.modal-title').text('Excluir Condomínio #' + id);
  		modal.find('#confirm').attr('href', 'deletarCondominio.php?id=' + id);
  		break;
  	case "morador":
  		modal.find('.modal-title').text('Excluir Morador #' + id);
  		modal.find('#confirm').attr('href', 'deletarMorador.php?id=' + id);
  		break;
  	case "aviso":
  		modal.find('.modal-title').text('Excluir Aviso #' + id);
  		modal.find('#confirm').attr('href', 'deletarAviso.php?id=' + id);
  		break;
  }
  
>>>>>>> 383c10ba9d48ad89772a8dd6c1115cb2aaa3efe1
})