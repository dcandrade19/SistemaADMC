<?php
include_once "database.php";

class bloco {
    
    private $id = 0;
    private $nome = '';
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
    function setNome($nome){
        $this->nome = $nome;
    }
    
    function getNome(){
        return $this->nome;
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
        $this->dbh->exec("INSERT INTO blocos(nome,status,id_condominio) VALUES ('$this->nome','$this->status','$this->id_condominio')");
        $lastId = $this->dbh->lastInsertId();
        $this->read($lastId);
    }
    
    function read($id){
        $result = $this->dbh->query("SELECT * FROM blocos WHERE id = $id");
        $usrArray = $result->fetchAll(PDO::FETCH_ASSOC);
        $this->setId($usrArray[0]['id']);
        $this->setNome($usrArray[0]['nome']);
        $this->setStatus($usrArray[0]['status']);
        $this->setId_condominio($usrArray[0]['id_condominio']);
    }
    
    function update(){
        $this->dbh->exec("UPDATE blocos SET nome='$this->nome',status='$this->status',id_condominio='$this->id_condominio' WHERE id = $this->id");
        $this->read($this->id);
    }
    
    function delete(){
        $this->dbh->exec("DELETE FROM blocos WHERE id = $this->id");
        $this->id = 0; // Remover referência
    }
}
?>