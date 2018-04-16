<?php
include_once "database.php";

class servico {
    
    private $id = 0;
    private $situacao = '';
    private $descricao = '';
    private $id_despesa = '';
    private $id_solicitante = 0;
    private $dbh = '';
    
    function __construct(){
        $this->dbh = dataBase::getHandler();
    }
    
    function setId($id){
        $this->id = $id;
    }
    
    function getId(){
        return $this->id;
    }
    function setSituacao($situacao){
        $this->situacao = $situacao;
    }
    
    function getSituacao(){
        return $this->situacao;
    }
    
    function setDescricao($descricao){
        $this->descricao = $descricao;
    }
    
    function getDescricao(){
        return $this->descricao;
    }
    
    function setId_despesa($id_despesa){
        $this->id_despesa = $id_despesa;
    }
    
    function getId_despesa(){
        return $this->id_despesa;
    }
    
    function setId_solicitante($id_solicitante){
        $this->id_solicitante = $id_solicitante;
    }
    
    function getId_solicitante(){
        return $this->id_solicitante;
    }
    
    function create(){
        $this->dbh->exec("INSERT INTO servicos(situacao,descricao,id_despesa,id_solicitante) VALUES ('$this->situacao','$this->id_despesa','$this->descricao','$this->id_solicitante')");
        $lastId = $this->dbh->lastInsertId();
        $this->read($lastId);
    }
    
    function read($id){
        $result = $this->dbh->query("SELECT * FROM servicos WHERE id = $id");
        $usrArray = $result->fetchAll(PDO::FETCH_ASSOC);
        $this->setId($usrArray[0]['id']);
        $this->setSituacao($usrArray[0]['situacao']);
        $this->setDescricao($usrArray[0]['descricao']);
        $this->setId_despesa($usrArray[0]['id_despesa']);
        $this->setId_solicitante($usrArray[0]['id_solicitante']);
    }
    
    function update(){
        $this->dbh->exec("UPDATE servicos SET situacao='$this->situacao',descricao='$this->descricao',id_despesa='$this->id_despesa',id_solicitante='$this->id_solicitante' WHERE id = $this->id");
        $this->read($this->id);
    }
    
    function delete(){
        $this->dbh->exec("DELETE FROM servicos WHERE id = $this->id");
        $this->id = 0; // Remover referência
    }
}
?>