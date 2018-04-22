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
    
    function getStatusB(){
        if($this->status){
            return '<span class="badge badge-success">Ativado</span>';
        }else{
            return '<span class="badge badge-danger">Desativado</span>';
        }
    }
    
    function setNivel($nivel){
        $this->nivel = $nivel;
    }
    
    function getNivel(){
        return $this->nivel;
    }
    
    function getTipo(){
        if($this->nivel == 0){
            return '<span class="badge badge-secondary">Administrador</span>';
        }elseif($this->nivel == 1){
            return '<span class="badge badge-warning">Sindico</span>';
        }elseif($this->nivel == 2){
            return '<span class="badge badge-primary">Morador</span>';
        }
    }
    
    function create(){
        $this->dbh->exec("INSERT INTO usuarios(login,senha,status,nivel) VALUES ('$this->login','$this->senha','$this->status','$this->nivel')");
        $lastId = $this->dbh->lastInsertId();
        $this->read($lastId);
    }
    
    function read($id){
        $result = $this->dbh->query("SELECT * FROM usuarios WHERE id = $id");
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $this->setId($row['id']);
            $this->setLogin($row['login']);
            $this->setSenha($row['senha']);
            $this->setStatus($row['status']);
            $this->setNivel($row['nivel']);
        }     
    }
    
    function update(){
        $this->dbh->exec("UPDATE usuarios SET login='$this->login',senha='$this->senha',status='$this->status',nivel='$this->nivel' WHERE id = $this->id");
        $this->read($this->id);
    }
    
    function delete(){
        $this->dbh->exec("DELETE FROM usuarios WHERE id = $this->id");
        $this->id = 0; // Remover referência
    }
    
    static function getAll(){
        $dbh = dataBase::getHandler();
        $result = $dbh->query("SELECT * FROM usuarios");
        $usrArray = $result->fetchAll(PDO::FETCH_ASSOC);
        $x=0;
        foreach ($usrArray as $row) {
            $usuario = new usuario();
            $usuario->read($row[id]);
            $retorno[$x] = $usuario;
            $x++;
        }
        return $retorno;
    }
    
    static function search($keyword = ""){
        $dbh = dataBase::getHandler();
        $retorno = null;
        $result = $dbh->query("SELECT * FROM usuarios WHERE login = '$keyword' LIMIT 1");
        $n = count($result);
        if ($n > 0) {
        $found = $result->fetchAll(PDO::FETCH_ASSOC);
        foreach ($found as $row) {
            $usuario = new usuario();
            $usuario->read($row['id']);
            $retorno = $usuario;
        }
        }
        return $retorno;
    }
}
?>