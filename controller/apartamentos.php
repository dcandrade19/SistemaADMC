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
    $apartamento = new apartamento();
    if($_POST[id]!='') $apartamento->read($_POST[id]);
    $apartamento->setNumero($_POST[numero]);
    $apartamento->setStatus($_POST[status]);
    $apartamento->setId_bloco($_POST[id_bloco]);
    if($_POST[id]!=''){
        $apartamento->update();
        $texto = 'editado';
    }else{
        $apartamento->create();
        $texto = 'salvo';
    }
    $res = '
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    Apartamento <strong>'.$apartamento->getNumero().'</strong> '.$texto.' com sucesso!!!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>';
    
}elseif($_GET[action]=='delete'){
    $apartamento = new apartamento();
    $apartamento->read($_GET[id]);
    $numero_salvo = $apartamento->getNumero();
    $apartamento->delete();
    $res = '
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    Apartamento <strong>'.$numero_salvo.'</strong> deletado com sucesso!!!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>';
}elseif($_GET[action]=='edit'){
    $apartamentoEdicao = new apartamento();
    $apartamentoEdicao->read($_GET[id]);
    $numero = $apartamentoEdicao->getNumero();
    $status = $apartamentoEdicao->getStatus();
    $id_bloco = $apartamentoEdicao->getId_bloco();
    $id = $apartamentoEdicao->getId();
    echo '<script>
        $(document).ready(function(){
        $("#modal_apartamentos").modal();
        });
          </script>';
}

if($_POST[action]=='filtrar'){
    $apartamentos = apartamento::search($_POST[filtro],$modo);
    $qtd = sizeof($apartamentos);
    if ($qtd == 0) {
        $texto = 'Nenhum apartamento encontrado!!!';
        $qtd = null;
    }else if ($qtd == 1) {
        $texto = 'apartamento encontrado!!!';
    }else {
        $texto = 'apartamentos encontrados!!!';
    }
    $resf = '
    <div class="alert alert-info alert-dismissible fade show" role="alert">
    <strong>'.$qtd.'</strong> '.$texto. '
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>';
}else{
    $apartamentos = apartamento::getAll($modo);
    $qtd = sizeof($apartamentos);
    if(empty($res)) {
        $resf = '
    <div class="alert alert-dark alert-dismissible fade show" role="alert">
    Exibindo <strong>'.$qtd.'</strong> registros.
    </div>';
    }
    
}

if(sizeof($apartamentos)){
    $tb_head = '<table class="table lista-itens">
            <thead>
            <tr class="tr-head">
            <th scope="col">#</th>
            <th scope="col">Numero</th>
            <th scope="col">Bloco</th>
            <th scope="col">Status</th>
            <th scope="col">Opções</th>
            </tr>
            ';
    $tb_end = '</table>';
    foreach ($apartamentos as $apartamento) {
        $tb_content .= '</thead>
            <tbody>
            <tr><th scope="row">'.$apartamento->getId().'</th>
            <td>'.$apartamento->getNumero().'</td>
            <td>'.$apartamento->getNomeBloco($apartamento->getId_bloco()).'</td>
            <td>'.$apartamento->getStatus().'</td>
            <td>
            <a class="icone edit" href="?controller=apartamentos&action=edit&id='.
            $apartamento->getId().'"data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
            <a class="icone del" href="?controller=apartamentos&action=delete&id='.
            $apartamento->getId().'"data-toggle="tooltip" data-placement="top" title="Deletar"><i class="fas fa-trash-alt"></i></a> </td>
            </tr>
            </tbody>';
            
    }
    $tb = $tb_head .$tb_content .$tb_end;
}

if(sizeof($apartamentos)){
    foreach ($apartamentos as $apartamento) {
        $cond .= "<div class='col-xs-12 text-center'> <div class='btn-menu' onclick='location.href='?teste''> <i class='fas fa-key fa-3x'></i> <p>".
            $apartamento->getNumero().
            "</p> <div class='mi-btn'>".
            "<a class='icone edit' href='?controller=apartamentos&action=edit&id=".
            $apartamento->getId()."'data-toggle='tooltip' data-placement='top' title='Editar'><i class='fas fa-edit'></i></a>".
            "<a class='icone del' href='?controller=apartamentos&action=delete&id=".
            $apartamento->getId()."'data-toggle='tooltip' data-placement='top' title='Deletar'><i class='fas fa-trash-alt'></i></a> </div></div>".$apartamento->getStatus()."</div>";
            
    }
}

include "./view/menu.php";
?>