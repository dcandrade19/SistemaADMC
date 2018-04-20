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
    $bloco = new bloco();
    if($_POST[id]!='') $bloco->read($_POST[id]);
    $bloco->setNome($_POST[nome]);
    $bloco->setStatus($_POST[status]);
    $bloco->setId_condominio($_POST[id_condominio]);
    if($_POST[id]!=''){
        $bloco->update();
        $texto = 'editado';
    }else{
        $bloco->create();
        $texto = 'salvo';
    }
    $res = '
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    Bloco <strong>'.$bloco->getNome().'</strong> '.$texto.' com sucesso!!!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>';
    
}elseif($_GET[action]=='delete'){
    $bloco = new bloco();
    $bloco->read($_GET[id]);
    $nome_salvo = $bloco->getNome();
    $bloco->delete();
    $res = '
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    Bloco <strong>'.$nome_salvo.'</strong> deletado com sucesso!!!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>';
    
}elseif($_GET[action]=='edit'){
    $blocoEdicao = new bloco();
    $blocoEdicao->read($_GET[id]);
    $nome = $blocoEdicao->getNome();
    $status = $blocoEdicao->getStatus();
    $id_condominio = $blocoEdicao->getId_condominio();
    $id = $blocoEdicao->getId();
    echo '<script>
        $(document).ready(function(){
        $("#modal_blocos").modal();
        });
          </script>';
}

if($_POST[action]=="filtrar"){
    $blocos = bloco::search($_POST[filtro],$modo);
    $qtd = sizeof($blocos);
    if ($qtd == 0) {
        $texto = 'Nenhum bloco encontrado!!!';
        $qtd = null;
    }else if ($qtd == 1) {
        $texto = 'bloco encontrado!!!';
    }else {
        $texto = 'blocos encontrados!!!';
    }
    $res = '
    <div class="alert alert-info alert-dismissible fade show" role="alert">
    <strong>'.$qtd.'</strong> '.$texto. '
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>';
}else{
    $blocos = bloco::getAll($modo);
    $qtd = sizeof($blocos);
    if(empty($res)) {
        $res = '
    <div class="alert alert-dark alert-dismissible fade show" role="alert">
    Exibindo <strong>'.$qtd.'</strong> registros.
    </div>';
    }
}

if(sizeof($blocos)){
    $tb_head = '<table class="table lista-itens">
            <thead>
            <tr id="tr-head">
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Condominio</th>
            <th scope="col">Status</th>
            <th scope="col">Opções</th>
            </tr>
            ';
    $tb_end = '</table>';
    foreach ($blocos as $bloco) {
        $tb_content .= '</thead>
            <tbody>
            <tr><th scope="row">'.$bloco->getId().'</th>
            <td>'.$bloco->getNome().'</td>
            <td>'.$bloco->getNomeCondominio($bloco->getId_condominio()).'</td>
            <td>'.$bloco->getStatus().'</td>
            <td>
            <a class="icone edit" href="?controller=blocos&action=edit&id='.
            $bloco->getId().'"data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
            <a class="icone del" href="?controller=blocos&action=delete&id='.
            $bloco->getId().'"data-toggle="tooltip" data-placement="top" title="Deletar"><i class="fas fa-trash-alt"></i></a> </td>
            </tr>
            </tbody>';
            
    }
    $cond = $tb_head .$tb_content .$tb_end;
}

if(sizeof($blocos)){
    foreach ($blocos as $bloco) {
        $tb .= "<div class='col-xs-12 text-center'> <div class='btn-menu' onclick='location.href='?teste''> <i class='fas fa-th-large fa-3x'></i> <p>".
            $bloco->getNome().
            "</p> <div class='mi-btn'>".
            "<a class='icone edit' href='?controller=blocos&action=edit&id=".
            $bloco->getId()."'data-toggle='tooltip' data-placement='top' title='Editar'><i class='fas fa-edit'></i></a>".
            "<a class='icone del' href='?controller=blocos&action=delete&id=".
            $bloco->getId()."'data-toggle='tooltip' data-placement='top' title='Deletar'><i class='fas fa-trash-alt'></i></a> </div></div>".$bloco->getStatus()."</div>";
            
    }
}

include "./view/menu.php";
?>