<?php
include_once "database.php";

class despesa {
    
    private $id = 0;
    private $titulo = '';
    private $descricao = '';
    private $valor = '';
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
    
    function setValor($valor){
        $this->valor = $valor;
    }
    
    function getValor(){
        return $this->valor;
    }
    
    function create(){
        $this->dbh->exec("INSERT INTO despesas(titulo,descricao,valor) VALUES ('$this->titulo','$this->descricao','$this->valor')");
        $lastId = $this->dbh->lastInsertId();
        $this->read($lastId);
    }
    
    function read($id){
        $result = $this->dbh->query("SELECT * FROM despesas WHERE id = $id");
        $usrArray = $result->fetchAll(PDO::FETCH_ASSOC);
        $this->setId($usrArray[0]['id']);
        $this->setTitulo($usrArray[0]['titulo']);
        $this->setDescricao($usrArray[0]['descricao']);
        $this->setValor($usrArray[0]['valor']);
    }
    
    function update(){
        $this->dbh->exec("UPDATE despesas SET titulo='$this->titulo',descricao='$this->descricao',valor='$this->valor' WHERE id = $this->id");
        $this->read($this->id);
    }
    
    function delete(){
        $this->dbh->exec("DELETE FROM despesas WHERE id = $this->id");
        $this->id = 0; // Remover referência
    }
}
?>