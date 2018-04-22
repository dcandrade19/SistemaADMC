<?php
$modo = 2;
if ($_POST[select_opcoes]) {
    if ($_POST[select_opcoes] == 'Todos') {
        $modo = 2;
    } elseif ($_POST[select_opcoes] == 'Ativados'){
        $modo = 1;
    } elseif ($_POST[select_opcoes] == 'Desativados'){
        $modo = 0;
    }
}

if($_POST[action]=="createupdate"){
    $morador = new morador();
    if($_POST[id]!='') $morador->read($_POST[id]);
    $morador->setNome($_POST[nome]);
    $morador->setStatus($_POST[status]);
    $morador->setCpf($_POST[cpf]);
    $morador->setId_apartamento($_POST[id_apartamento]);
    $morador->setId_usuario($_POST[id_usuario]);
    //$morador->setId_usuario($_POST[id_usuario]);
    $string = explode(" ", $morador->getNome());
    $nomedeusuario = $string[0];
    $usuario = new usuario(); 
    $usuario->setLogin($_POST[login]);
    $novasenha = $_POST[senha];
    if ($novasenha != '') {
        $usuario->setSenha(password_hash($novasenha, PASSWORD_DEFAULT));
    } else {
        $usuario->setSenha(password_hash('123456', PASSWORD_DEFAULT));
    } 
    $usuario->setStatus($_POST[usuario_status]);
    $usuario->setNivel($_POST[nivel]);
    if($_POST[id_usuario]!='') {
        $usuario->read($_POST[id_usuario]);
        $usuario->setLogin($_POST[login]);
        $novasenha = $_POST[senha];
        if ($novasenha != '') {
            $usuario->setSenha(password_hash($novasenha, PASSWORD_DEFAULT));
        }
        $usuario->setStatus($_POST[usuario_status]);
        $usuario->setNivel($_POST[nivel]);
    }
    if($_POST[id]!=''){
        $morador->update();
        $usuario->update();
        $texto = 'editado';
    }else{
        $usuario->create();
        $morador->setId_usuario($usuario->getId());
        $morador->create();
        $texto = 'salvo';
    }
    $res = '
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    Morador <strong>'.$morador->getNome().'</strong> '.$texto.' com sucesso!!!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>';
    
}elseif($_GET[action]=='delete'){
    $morador = new morador();
    $morador->read($_GET[id]);
    $nome_salvo = $morador->getNome();
    $morador->delete();
    $usuario = new usuario();
    $usuario->read($morador->getId_usuario());
    $usuario->delete();
    $res = '
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    Morador <strong>'.$nome_salvo.'</strong> deletado com sucesso!!!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>';
}elseif($_GET[action]=='edit'){
    $moradorEdicao = new morador();
    $moradorEdicao->read($_GET[id]);
    $nome = $moradorEdicao->getNome();
    $status = $moradorEdicao->getStatus();
    $cpf = $moradorEdicao->getCpf();
    $id = $moradorEdicao->getId();
    $usuarioEdicao = new usuario();
    $usuarioEdicao->read($moradorEdicao->getId_usuario());
    $login = $usuarioEdicao->getLogin();
    $status = $usuarioEdicao->getStatus();
    $senha = $usuarioEdicao->getSenha();
    $nivel = $usuarioEdicao->getNivel();
    $id_usuario = $usuarioEdicao->getId();
    echo '<script>
        $(document).ready(function(){
        $("#modal_moradores").modal();
        });
          </script>';
}elseif($_GET[action]=='view'){
    if ($_GET[id] === $_SESSION['id']) {
        $usuario = new usuario();
        $usuario->read($_GET[id]);
        $morador_usuario = $usuario->getLogin();
        $morador_status = $usuario->getStatus();
        $morador_senha = $usuario->getSenha();
        $morador_tipo = $usuario->getTipo();
        
        $morador = new morador();
        $morador = $morador->getMoradoresPorId_usuario($_GET[id]);
        if ($morador) {
            $morador->read($morador->getId());
            $nome = $morador->getNome();
            $status = $morador->getStatus();
            $cpf = $morador->getCpf();
            $apartamento = new apartamento();
            $apartamento->read($morador->getId_apartamento());
            $morador_apt = $apartamento->getNumero();
            $bloco = new bloco();
            $bloco->read($apartamento->getId_bloco());
            $morador_bloco = $bloco->getNome();
            $condominio = new condominio();
            $condominio->read($bloco->getId_condominio());
            $morador_condominio = $condominio->getNome();
        } else {
            $nome = $morador_usuario;
            $status = '<span class="badge badge-success">Ativado</span>';
            $cpf = '000.000.000-00';
            $morador_apt = '00';
            $morador_bloco = 'Nenhum';
            $morador_condominio = 'Nenhum';
        }
        
        
        echo '<script>
        $(document).ready(function(){
        $("#modal_view_perfil").modal();
        });
          </script>';
    }
    
}

if($_POST[action]=='filtrar'){
    $moradores = morador::search($_POST[filtro],$modo);
    $qtd = sizeof($moradores);
    if ($qtd == 0) {
        $texto = 'Nenhum morador encontrado!!!';
        $qtd = null;
    }else if ($qtd == 1) {
        $texto = 'morador encontrado!!!';
    }else {
        $texto = 'moradores encontrados!!!';
    }
    $resf = '
    <div class="alert alert-info alert-dismissible fade show" role="alert">
    <strong>'.$qtd.'</strong> '.$texto. '
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>';
}else{
    $moradores = morador::getAll($modo);
    $qtd = sizeof($moradores);
    if(empty($res)) {
        $resf = '
    <div class="alert alert-dark alert-dismissible fade show" role="alert">
    Exibindo <strong>'.$qtd.'</strong> registros.
    </div>';
    }
    
}

if(sizeof($moradores)){
    $tb_head = '<table class="table lista-itens">
            <thead>
            <tr class="tr-head">
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Cpf</th>
            <th scope="col">Apt</th>
            <th scope="col">Usuario</th>
            <th scope="col">Tipo</th>
            <th scope="col">Login</th>
            <th scope="col">Status</th>
            <th scope="col">Opções</th>
            </tr>
            ';
    $tb_end = '</table>';
    foreach ($moradores as $morador) {
        $usuario = $morador->getUsuario($morador->getId_usuario());
        $login_u = $usuario->getLogin();
        $tipo = $usuario->getTipo();
        $status_usuario = $usuario->getStatusB();
        $tb_content .= '</thead>
            <tbody>
            <tr><th scope="row">'.$morador->getId().'</th>
            <td>'.$morador->getNome().'</td>
            <td>'.$morador->getCpf().'</td>
            <td>'.$morador->getNumeroApartamento($morador->getId_apartamento()).'</td>
            <td>'.$login_u.'</td>
            <td>'.$tipo.'</td>
            <td>'.$status_usuario.'</td>
            <td>'.$morador->getStatus().'</td>
            <td>
            <a class="icone edit" href="?controller=moradores&action=edit&id='.
            $morador->getId().'"data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
            <a class="icone del" href="?controller=moradores&action=delete&id='.
            $morador->getId().'"data-toggle="tooltip" data-placement="top" title="Deletar"><i class="fas fa-trash-alt"></i></a> </td>
            </tr>
            </tbody>';
            
    }
    $tb = $tb_head .$tb_content .$tb_end;
}

if(sizeof($moradores)){
    foreach ($moradores as $morador) {
        $usuario = $morador->getUsuario($morador->getId_usuario());
        $tipo = $usuario->getTipo();
        $cond .= "<div class='col-xs-12 text-center'> <div class='btn-menu' onclick='location.href='?teste''> <i class='fas fa-user fa-3x'></i> <p>".
            $morador->getNome().
            "</p> <div class='mi-btn'>".
            "<a class='icone edit' href='?controller=moradores&action=edit&id=".
            $morador->getId()."'data-toggle='tooltip' data-placement='top' title='Editar'><i class='fas fa-edit'></i></a>".
            "<a class='icone del' href='?controller=moradores&action=delete&id=".
            $morador->getId()."'data-toggle='tooltip' data-placement='top' title='Deletar'><i class='fas fa-trash-alt'></i></a> </div></div>".$tipo .'|'. $morador->getStatus()."</div>";
            
    }
}

include "./view/menu.php";
?>