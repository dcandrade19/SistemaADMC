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
    
    if(isset($_POST['login'])){
        $nome = strtolower($_POST['login']);
        
        $novo_nome = explode(" ", $nome);
 
        echo  $novo_nome[0];


    }
    
   
?>