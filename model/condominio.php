<?php
include_once "database.php";

class condominio {
    
    private $id = 0;
    private $nome = '';
    private $endereco = '';
    private $status = '';
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
    
    function setEndereco($endereco){
        $this->endereco = $endereco;
    }
    
    function getEndereco(){
        return $this->endereco;
    }
    
    function setStatus($status){
        $this->status = $status;
    }
    
    function getStatus(){
        return $this->status;
    }
    
    function getStatusBadge(){
        if($this->status){
            return '<span class="badge badge-success">Ativado</span>';
        }else{
            return '<span class="badge badge-danger">Desativado</span>';
        }
    }
    
    function create(){
        $this->dbh->exec("INSERT INTO condominios(nome,endereco,status) VALUES ('$this->nome','$this->endereco','$this->status')");
        $lastId = $this->dbh->lastInsertId();
        $this->read($lastId);
    }
    
    function read($id){
        $result = $this->dbh->query("SELECT * FROM condominios WHERE id = {$id}");
        if($result != false){
            $usrArray = $result->fetchAll(PDO::FETCH_ASSOC);
            $this->setId($usrArray[0]['id']);
            $this->setNome($usrArray[0]['nome']);
            $this->setEndereco($usrArray[0]['endereco']);
            $this->setStatus($usrArray[0]['status']);
        }
        
    }
    
    function update(){
        $this->dbh->exec("UPDATE condominios SET nome='$this->nome',endereco='$this->endereco',status='$this->status' WHERE id = $this->id");
        $this->read($this->id);
    }
    
    function delete(){
        $this->dbh->exec("DELETE FROM condominios WHERE id = $this->id");
        $this->id = 0; // Remover referência
    }
    
    
    static function getAll($status = 2){
        if ($status == 2) {
            $complemento = '';
        } else {
            $complemento = 'WHERE status = ' .$status;
        }
        $dbh = dataBase::getHandler();
        $result = $dbh->query("SELECT id FROM condominios $complemento ORDER BY id DESC");
        $chmArray = $result->fetchAll(PDO::FETCH_ASSOC);
        $x=0;
        foreach ($chmArray as $row) {
            $condominio = new condominio();
            $condominio->read($row[id]);
            $retorno[$x] = $condominio;
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
        $result = $dbh->query("SELECT id FROM condominios $complemento nome LIKE '%$keyword%' ORDER BY id DESC");
        
        $chmArray = $result->fetchAll(PDO::FETCH_ASSOC);
        $x=0;
        foreach ($chmArray as $row) {
            $condominio = new condominio();
            $condominio->read($row[id]);
            $retorno[$x] = $condominio;
            $x++;
        }
        return $retorno;
    }
}
?>