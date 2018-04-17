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
        if($this->status){
            return 'Ativado';
        }else{
            return 'Desativado';
        }
    }
    
    function create(){
        $this->dbh->exec("INSERT INTO condominios(nome,endereco,status) VALUES ('$this->nome','$this->endereco','$this->status')");
        $lastId = $this->dbh->lastInsertId();
        $this->read($lastId);
    }
    
    function read($id){
        $result = $this->dbh->query("SELECT * FROM condominios WHERE id = $id");
        $usrArray = $result->fetchAll(PDO::FETCH_ASSOC);
        $this->setId($usrArray[0]['id']);
        $this->setNome($usrArray[0]['nome']);
        $this->setEndereco($usrArray[0]['endereco']);
        $this->setStatus($usrArray[0]['status']);
    }
    
    function update(){
        $this->dbh->exec("UPDATE condominios SET nome='$this->nome',endereco='$this->endereco',status='$this->status' WHERE id = $this->id");
        $this->read($this->id);
    }
    
    function delete(){
        $this->dbh->exec("DELETE FROM condominios WHERE id = $this->id");
        $this->id = 0; // Remover referência
    }
    
    
    static function getAll($status = 1){
        $dbh = dataBase::getHandler();
        $result = $dbh->query("SELECT id FROM condominios WHERE status = $status ORDER BY id DESC");
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
    
    static function search($keyword = "", $status = 1){
        $dbh = dataBase::getHandler();
        $result = $dbh->query("SELECT id FROM condominios WHERE status = $status AND nome LIKE '%$keyword%' ORDER BY id DESC");
        
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