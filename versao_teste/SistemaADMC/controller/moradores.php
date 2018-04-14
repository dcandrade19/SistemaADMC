<?php
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
    }else{
        $morador->create();
    }
    $res = "Morador salvo com sucesso!!!";
    
}elseif($_GET[action]=='delete'){
    $morador = new morador();
    $morador->read($_GET[id]);
    $morador->delete();
    
}elseif($_GET[action]=='edit'){
    $moradorEdicao = new morador();
    $moradorEdicao->read($_GET[id]);
    $nome = $moradorEdicao->getNome();
    $status = $moradorEdicao->getStatus();
    $cpf = $moradorEdicao->getCpf();
    $id_apartamento = $moradorEdicao->getId_apartamento();
    $id_usuario = $moradorEdicao->getId_usuario();
    $id = $moradorEdicao->getId();
}

if($_POST[action]=="filtrar"){
    $moradores = morador::search($_POST[filtro]);
}else{
    $moradores = morador::getAll();
}

if(sizeof($moradores)){
    foreach ($moradores as $morador) {
        $tbl .= "<p>".
            $morador->getNome().
            " <a href='?controller=moradores&action=edit&id=".
            $morador->getId()."'>Editar</a> ".
            "<a href='?controller=moradores&action=delete&id=".
            $morador->getId()."'>Excluir</a>".
            "</p>";
    }
}

include "./view/moradores.php";
?>