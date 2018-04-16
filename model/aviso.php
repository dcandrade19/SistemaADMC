<?php
include_once "database.php";

class aviso {
    
    private $id = 0;
    private $titulo = '';
    private $descricao = '';
    private $status = '';
    private $id_condominio = 0;
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
    function setTitulo($titulo){
        $this->titulo = $titulo;
    }
    
    function getTitulo(){
        return $this->titulo;
    }
    
    function setDescricao($descricao){
        $this->descricao = $descricao;
    }
    
    function getDescricao(){
        return $this->descricao;
    }
    
    function setStatus($status){
        $this->status = $status;
    }
    
    function getStatus(){
        return $this->status;
    }
    
    function setId_condominio($id_condominio){
        $this->id_condominio = $id_condominio;
    }
    
    function getId_condominio(){
        return $this->id_condominio;
    }
    
    function create(){
        $this->dbh->exec("INSERT INTO avisos(titulo,descricao,status,id_condominio) VALUES ('$this->titulo','$this->status','$this->descricao','$this->id_condominio')");
        $lastId = $this->dbh->lastInsertId();
        $this->read($lastId);
    }
    
    function read($id){
        $result = $this->dbh->query("SELECT * FROM avisos WHERE id = $id");
        $usrArray = $result->fetchAll(PDO::FETCH_ASSOC);
        $this->setId($usrArray[0]['id']);
        $this->setTitulo($usrArray[0]['titulo']);
        $this->setDescricao($usrArray[0]['descricao']);
        $this->setStatus($usrArray[0]['status']);
        $this->setId_condominio($usrArray[0]['id_condominio']);
    }
    
    function update(){
        $this->dbh->exec("UPDATE avisos SET titulo='$this->titulo',descricao='$this->descricao',status='$this->status',id_condominio='$this->id_condominio' WHERE id = $this->id");
        $this->read($this->id);
    }
    
    function delete(){
        $this->dbh->exec("DELETE FROM avisos WHERE id = $this->id");
        $this->id = 0; // Remover referência
    }
}
?>