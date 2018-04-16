<?php
include_once "database.php";

class morador {
    
    private $id = 0;
    private $nome = '';
    private $status = '';
    private $cpf = '';
    private $id_apartamento = 0;
    private $id_usuario = 0;
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
    
    function setCpf($cpf){
        $this->cpf = $cpf;
    }
    
    function getCpf(){
        return $this->cpf;
    }
    
    function setStatus($status){
        $this->status = $status;
    }
    
    function getStatus(){
        return $this->status;
    }
    
    function setId_apartamento($id_apartamento){
        $this->id_apartamento = $id_apartamento;
    }
    
    function getId_apartamento(){
        return $this->id_apartamento;
    }
    
    function setId_usuario($id_usuario){
        $this->id_usuario = $id_usuario;
    }
    
    function getId_usuario(){
        return $this->id_usuario;
    }
    
    function create(){
        $this->dbh->exec("INSERT INTO moradores(nome,cpf,status,id_apartamento,id_usuario) VALUES ('$this->nome','$this->cpf,'$this->status','$this->id_apartamento','$this->id_usuario')");
        $lastId = $this->dbh->lastInsertId();
        $this->read($lastId);
    }
    
    function read($id){
        $result = $this->dbh->query("SELECT * FROM moradores WHERE id = $id");
        $usrArray = $result->fetchAll(PDO::FETCH_ASSOC);
        $this->setId($usrArray[0]['id']);
        $this->setNome($usrArray[0]['nome']);
        $this->setCpf($usrArray[0]['cpf']);
        $this->setStatus($usrArray[0]['status']);
        $this->setId_apartamento($usrArray[0]['id_apartamento']);
        $this->setId_usuario($usrArray[0]['id_usuario']);
    }
    
    function update(){
        $this->dbh->exec("UPDATE moradores SET nome='$this->nome',cpf='$this->cpf',status='$this->status',id_apartamento='$this->id_apartamento',id_usuario='$this->id_usuario' WHERE id = $this->id");
        $this->read($this->id);
    }
    
    function delete(){
        $this->dbh->exec("DELETE FROM moradores WHERE id = $this->id");
        $this->id = 0; // Remover referência
    }
}
?>