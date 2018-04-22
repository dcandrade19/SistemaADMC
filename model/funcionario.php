<?php
include_once "database.php";

class funcionario {
    
    private $id = 0;
    private $nome = '';
    private $status = '';
    private $cpf = '';
    private $id_despesa = '';
    private $id_funcao = 0;
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
    
    function setCpf($cpf){
        $this->cpf = $cpf;
    }
    
    function getCpf(){
        return $this->cpf;
    }
    
    function setId_despesa($id_despesa){
        $this->id_despesa = $id_despesa;
    }
    
    function getId_despesa(){
        return $this->id_despesa;
    }
    
    function setStatus($status){
        $this->status = $status;
    }
    
    function getStatus(){
        if($this->status){
            return '<span class="badge badge-success">Ativado</span>';
        }else{
            return '<span class="badge badge-danger">Desativado</span>';
        }
    }
    
    function setId_funcao($id_funcao){
        $this->id_funcao = $id_funcao;
    }
    
    function getId_funcao(){
        return $this->id_funcao;
    }
    
    function setId_condominio($id_condominio){
        $this->id_condominio = $id_condominio;
    }
    
    function getId_condominio(){
        return $this->id_condominio;
    }
    
    function create(){
        $this->dbh->exec("INSERT INTO funcionarios(nome,cpf,status,id_despesa,id_funcao,id_condominio) VALUES ('$this->nome','$this->cpf,'$this->status','$this->id_despesa','$this->id_funcao','$this->id_condominio')");
        $lastId = $this->dbh->lastInsertId();
        $this->read($lastId);
    }
    
    function read($id){
        $result = $this->dbh->query("SELECT * FROM funcionarios WHERE id = $id");
        $usrArray = $result->fetchAll(PDO::FETCH_ASSOC);
        $this->setId($usrArray[0]['id']);
        $this->setNome($usrArray[0]['nome']);
        $this->setCpf($usrArray[0]['cpf']);
        $this->setStatus($usrArray[0]['status']);
        $this->setId_despesa($usrArray[0]['id_despesa']);
        $this->setId_funcao($usrArray[0]['id_funcao']);
        $this->setId_condominio($usrArray[0]['id_condominio']);
    }
    
    function update(){
        $this->dbh->exec("UPDATE funcionarios SET nome='$this->nome',cpf='$this->cpf',status='$this->status',id_despesa='$this->id_despesa',id_funcao='$this->id_funcao',id_condominio='$this->id_condominio' WHERE id = $this->id");
        $this->read($this->id);
    }
    
    function delete(){
        $this->dbh->exec("DELETE FROM funcionarios WHERE id = $this->id");
        $this->id = 0; // Remover referência
    }
    
    static function getAll($status = 2){
        if ($status == 2) {
            $complemento = '';
        } else {
            $complemento = 'WHERE status = ' .$status;
        }
        $dbh = dataBase::getHandler();
        $result = $dbh->query("SELECT id FROM funcionarios $complemento ORDER BY id DESC");
        $chmArray = $result->fetchAll(PDO::FETCH_ASSOC);
        $x=0;
        foreach ($chmArray as $row) {
            $funcionario = new funcionario();
            $funcionario->read($row[id]);
            $retorno[$x] = $funcionario;
            $x++;
        }
        return $retorno;
    }
    
    static function search($keyword = "", $status = 2){
        if ($status == 2) {
            $complemento = 'WHERE';
        } else {
            $complemento = 'WHERE status = ' .$status. ' AND';
            echo $status;
        }
        $dbh = dataBase::getHandler();
        $result = $dbh->query("SELECT id FROM funcionarios $complemento nome LIKE '%$keyword%' ORDER BY id DESC");
        
        $chmArray = $result->fetchAll(PDO::FETCH_ASSOC);
        $x=0;
        foreach ($chmArray as $row) {
            $funcionario = new funcionario();
            $funcionario->read($row[id]);
            $retorno[$x] = $funcionario;
            $x++;
        }
        return $retorno;
    }
}
?>