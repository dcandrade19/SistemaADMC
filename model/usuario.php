<?php
include_once "database.php";

class usuario {
    
    private $id = 0;
    private $login = '';
    private $senha = '';
    private $status = '';
    private $nivel = '';
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
    function setLogin($login){
        $this->login = $login;
    }
    
    function getLogin(){
        return $this->login;
    }
    
    function setSenha($senha){
        $this->senha = $senha;
    }
    
    function getSenha(){
        return $this->senha;
    }
    
    function setStatus($status){
        $this->status = $status;
    }
    
    function getStatus(){
        return $this->status;
    }
    
    function setNivel($nivel){
        $this->nivel = $nivel;
    }
    
    function getNivel(){
        return $this->nivel;
    }
    
    function create(){
        $this->dbh->exec("INSERT INTO usuarios(login,senha,status,nivel) VALUES ('$this->login','$this->senha','$this->status','$this->nivel')");
        $lastId = $this->dbh->lastInsertId();
        $this->read($lastId);
    }
    
    function read($id){
        $result = $this->dbh->query("SELECT * FROM usuarios WHERE id = $id");
        $usrArray = $result->fetchAll(PDO::FETCH_ASSOC);
        $this->setId($usrArray[0]['id']);
        $this->setLogin($usrArray[0]['login']);
        $this->setSenha($usrArray[0]['senha']);
        $this->setStatus($usrArray[0]['status']);
        $this->setNivel($usrArray[0]['nivel']);
    }
    
    function update(){
        $this->dbh->exec("UPDATE usuarios SET login='$this->login',senha='$this->senha',status='$this->status',nivel='$this->nivel' WHERE id = $this->id");
        $this->read($this->id);
    }
    
    function delete(){
        $this->dbh->exec("DELETE FROM usuarios WHERE id = $this->id");
        $this->id = 0; // Remover referência
    }
}
?>