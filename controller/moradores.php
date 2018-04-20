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
    if($_POST[id]!=''){
        $morador->update();
        $texto = 'editado';
    }else{
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
    echo '<script>
        $(document).ready(function(){
        $("#modal_moradores").modal();
        });
          </script>';
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
    $res = '
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
        $res = '
    <div class="alert alert-dark alert-dismissible fade show" role="alert">
    Exibindo <strong>'.$qtd.'</strong> registros.
    </div>';
    }
    
}

if(sizeof($moradores)){
    $tb_head = '<table class="table lista-itens">
            <thead>
            <tr id="tr-head">
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Cpf</th>
            <th scope="col">Apartamento</th>
            <th scope="col">Status</th>
            <th scope="col">Opções</th>
            </tr>
            ';
    $tb_end = '</table>';
    foreach ($moradores as $morador) {
        $tb_content .= '</thead>
            <tbody>
            <tr><th scope="row">'.$morador->getId().'</th>
            <td>'.$morador->getNome().'</td>
            <td>'.$morador->getCpf().'</td>
            <td>'.$morador->getNumeroApartamento($morador->getId_apartamento()).'</td>
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
        $cond .= "<div class='col-xs-12 text-center'> <div class='btn-menu' onclick='location.href='?teste''> <i class='fas fa-user fa-3x'></i> <p>".
            $morador->getNome().
            "</p> <div class='mi-btn'>".
            "<a class='icone edit' href='?controller=moradores&action=edit&id=".
            $morador->getId()."'data-toggle='tooltip' data-placement='top' title='Editar'><i class='fas fa-edit'></i></a>".
            "<a class='icone del' href='?controller=moradores&action=delete&id=".
            $morador->getId()."'data-toggle='tooltip' data-placement='top' title='Deletar'><i class='fas fa-trash-alt'></i></a> </div></div>".$morador->getStatus()."</div>";
            
    }
}

include "./view/menu.php";
?>