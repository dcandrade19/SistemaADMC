<?php
require_once '../config.php';
require_once '../functions.php';
include_once "../model/bloco.php";
include_once "../model/apartamento.php";
include_once "../model/morador.php";


    if(isset($_POST['id_condominio'])){
        $id_condominio = $_POST['id_condominio'];
        echo apartamento::doSelectBloco($id_condominio);
    }
    if(isset($_POST['id_bloco'])){
        $id_bloco = $_POST['id_bloco'];
        echo morador::doSelectApartamento($id_bloco);
    }
    
   if(isset($_POST['cpf'])){
        $cpf = $_POST['cpf'];
        echo validaCPF($cpf);
    }
    
    /*if(isset($_POST['login'])){
        $nome = strtolower($_POST['login']);
        
        //gerar senha aleatória ou usar 5 dígitos CPF
        $senha = '123456';
        
        $_POST['usuario']['login'] = $nome;
        $_POST['usuario']['senha'] = password_hash($senha, PASSWORD_DEFAULT);
        $_POST['usuario']['status'] = 1;
        $_POST['usuario']['nivel'] = $_POST['nivel'];
        
        
        $id = adicionarGenerico('usuario', 'usuarios');
        
        $array = array($nome, $senha, $id);
        
        echo json_encode($array);
        //echo $usuario =  gerar($nome);
    }*/
?>