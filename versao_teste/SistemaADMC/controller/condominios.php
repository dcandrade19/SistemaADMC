<?php
if($_POST[action]=="createupdate"){
    $condominio = new condominio();
    if($_POST[id]!='') $condominio->read($_POST[id]);
    $condominio->setNome($_POST[nome]);
    $condominio->setStatus($_POST[status]);
    $condominio->setEndereco($_POST[endereco]);
    if($_POST[id]!=''){
        $condominio->update();
    }else{
        $condominio->create();
    }
    $res = '
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    Condominio <strong>'.$condominio->getNome().'</strong> salvo com sucesso!!!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>';
    
}elseif($_GET[action]=='delete'){
    $condominio = new condominio();
    $condominio->read($_GET[id]);
    $nome_salvo = $condominio->getNome();
    $condominio->delete();
    $res = '
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    Condominio <strong>'.$nome_salvo.'</strong> deletado com sucesso!!!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>';
}elseif($_GET[action]=='edit'){
    $condominioEdicao = new condominio();
    $condominioEdicao->read($_GET[id]);
    $nome = $condominioEdicao->getNome();
    $status = $condominioEdicao->getStatus();
    $endereco = $condominioEdicao->getEndereco();
    $id = $condominioEdicao->getId();
}

if($_POST[action]=='filtrar' && $_POST[filtro] != ''){
    $condominios = condominio::search($_POST[filtro]);
    $qtd = sizeof($condominios);
    if ($qtd == 0) {
        $texto = 'Nenhum condominio encontrado!!!';
        $qtd = null;
    }else if ($qtd == 1) {
        $texto = 'condominio encontrado!!!';
    }else {
        $texto = 'condominios encontrados!!!';
    }    
    $res = '
    <div class="alert alert-info alert-dismissible fade show" role="alert">
    <strong>'.$qtd.'</strong> '.$texto. '
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>';
}else{
    $condominios = condominio::getAll();
    $qtd = sizeof($condominios);
    $res = '
    <div class="alert alert-dark fade show" role="alert">
    Exibindo <strong>'.$qtd.'</strong> registros.
    </div>';
}

if(sizeof($condominios)){
    foreach ($condominios as $condominio) {
        $tbl .= "<p>".
            $condominio->getNome().
            " <a href='?controller=condominios&action=edit&id=".
            $condominio->getId()."'>Editar</a> ".
            "<a href='?controller=condominios&action=delete&id=".
            $condominio->getId()."'>Excluir</a>".
            "</p>";
  }
}

if(sizeof($condominios)){
    foreach ($condominios as $condominio) {
        $cond .= "<div class='col-xs-12 text-center'> <div class='btn-menu' onclick='location.href='?teste''> <i class='far fa-building fa-3x'></i> <p>".
            $condominio->getNome().
            "</p> <div class='mi-btn'> <a class='icone view' href='?controller=condominios&action=view&id=".
            $condominio->getId()."'title='Detalhes'><i class='fas fa-eye'></i></a>".
            "<a class='icone edit' href='?controller=condominios&action=edit&id=".
            $condominio->getId()."'title='Editar'><i class='fas fa-edit'></i></a>".
            "<a class='icone del' href='?controller=condominios&action=delete&id=".
            $condominio->getId()."'title='Deletar'><i class='fas fa-trash-alt'></i></a> </div></div></div>";
        
    }
}

include "./view/menu.php";
?>