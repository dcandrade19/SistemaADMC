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
    $res = "Condominio salvo com sucesso!!!";
    
}elseif($_GET[action]=='delete'){
    $condominio = new condominio();
    $condominio->read($_GET[id]);
    $condominio->delete();
    
}elseif($_GET[action]=='edit'){
    $condominioEdicao = new condominio();
    $condominioEdicao->read($_GET[id]);
    $nome = $condominioEdicao->getNome();
    $status = $condominioEdicao->getStatus();
    $endereco = $condominioEdicao->getEndereco();
    $id = $condominioEdicao->getId();
}

if($_POST[action]=="filtrar"){
    $condominios = condominio::search($_POST[filtro]);
}else{
    $condominios = condominio::getAll();
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
            "</p> <div class='mi-btn'> <a href='?controller=condominios&action=view&id=".
            $condominio->getId()."'title='Detalhes'><i class='fas fa-eye'></i></a>".
            "<a href='?controller=condominios&action=edit&id=".
            $condominio->getId()."'title='Editar'><i class='fas fa-edit'></i></a>".
            "<a href='?controller=condominios&action=delete&id=".
            $condominio->getId()."'title='Deletar'><i class='fas fa-trash-alt'></i></a> </div></div></div>";
        
    }
}

//include "../view/menu.php";
?>