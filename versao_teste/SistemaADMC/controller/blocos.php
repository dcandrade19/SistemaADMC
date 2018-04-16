<?php
if($_POST[action]=="createupdate"){
    $bloco = new bloco();
    if($_POST[id]!='') $bloco->read($_POST[id]);
    $bloco->setNome($_POST[nome]);
    $bloco->setStatus($_POST[status]);
    $bloco->setId_condominio($_POST[id_condominio]);
    if($_POST[id]!=''){
        $bloco->update();
    }else{
        $bloco->create();
    }
    $res = "Bloco salvo com sucesso!!!";
    
}elseif($_GET[action]=='delete'){
    $bloco = new bloco();
    $bloco->read($_GET[id]);
    $bloco->delete();
    
}elseif($_GET[action]=='edit'){
    $blocoEdicao = new bloco();
    $blocoEdicao->read($_GET[id]);
    $nome = $blocoEdicao->getNome();
    $status = $blocoEdicao->getStatus();
    $id_condominio = $blocoEdicao->getId_condominio();
    $id = $blocoEdicao->getId();
}

if($_POST[action]=="filtrar"){
    $blocos = bloco::search($_POST[filtro]);
}else{
    $blocos = bloco::getAll();
}

if(sizeof($blocos)){
    foreach ($blocos as $bloco) {
        $tbl .= "<p>".
            $bloco->getNome().
            " <a href='?controller=blocos&action=edit&id=".
            $bloco->getId()."'>Editar</a> ".
            "<a href='?controller=blocos&action=delete&id=".
            $bloco->getId()."'>Excluir</a>".
            "</p>";
    }
}

if(sizeof($blocos)){
    foreach ($blocos as $bloco) {
        $cond .= "<div class='col-xs-12 text-center'> <div class='btn-menu' onclick='location.href='?teste''> <i class='fas fa-th-large fa-3x'></i> <p>".
            $bloco->getNome().
            "</p> <div class='mi-btn'> <a class='icone view' href='?controller=blocos&action=view&id=".
            $bloco->getId()."'title='Detalhes'><i class='fas fa-eye'></i></a>".
            "<a class='icone edit' href='?controller=blocos&action=edit&id=".
            $bloco->getId()."'title='Editar'><i class='fas fa-edit'></i></a>".
            "<a class='icone del' href='?controller=blocos&action=delete&id=".
            $bloco->getId()."'title='Deletar'><i class='fas fa-trash-alt'></i></a> </div></div></div>";
        
    }
}

include "./view/menu.php";
?>