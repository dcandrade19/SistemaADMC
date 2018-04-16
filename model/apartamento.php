<?php
include_once "database.php";

class apartamento {
    
    private $id = 0;
    private $numero = '';
    private $status = '';
    private $id_bloco = 0;
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
    function setNumero($numero){
        $this->numero = $numero;
    }
    
    function getNumero(){
        return $this->numero;
    }
    
    function setId_bloco($id_bloco){
        $this->id_bloco = $id_bloco;
    }
    
    function getId_bloco(){
        return $this->id_bloco;
    }
    
    function setStatus($status){
        $this->status = $status;
    }
    
    function getStatus(){
        return $this->status;
    }
    
    function create(){
        $this->dbh->exec("INSERT INTO apartamentos(numero,id_bloco,status) VALUES ('$this->numero','$this->id_bloco','$this->status')");
        $lastId = $this->dbh->lastInsertId();
        $this->read($lastId);
    }
    
    function read($id){
        $result = $this->dbh->query("SELECT * FROM apartamentos WHERE id = $id");
        $usrArray = $result->fetchAll(PDO::FETCH_ASSOC);
        $this->setId($usrArray[0]['id']);
        $this->setNumero($usrArray[0]['numero']);
        $this->setId_bloco($usrArray[0]['id_bloco']);
        $this->setStatus($usrArray[0]['status']);
    }
    
    function update(){
        $this->dbh->exec("UPDATE apartamentos SET numero='$this->numero',id_bloco='$this->id_bloco',status='$this->status' WHERE id = $this->id");
        $this->read($this->id);
    }
    
    function delete(){
        $this->dbh->exec("DELETE FROM apartamentos WHERE id = $this->id");
        $this->id = 0; // Remover referência
    }
    
    static function getAll($status = 1){
        $dbh = dataBase::getHandler();
        $result = $dbh->query("SELECT id FROM apartamentos WHERE status = $status ORDER BY id DESC");
        $chmArray = $result->fetchAll(PDO::FETCH_ASSOC);
        $x=0;
        foreach ($chmArray as $row) {
            $apartamento = new apartamento();
            $apartamento->read($row[id]);
            $retorno[$x] = $apartamento;
            $x++;
        }
        return $retorno;
    }
    
    static function search($keyword = "", $status = 1){
        $dbh = dataBase::getHandler();
        $result = $dbh->query("SELECT id FROM apartamentos WHERE status = $status AND numero LIKE '%$keyword%' ORDER BY id DESC");
        
        $chmArray = $result->fetchAll(PDO::FETCH_ASSOC);
        $x=0;
        foreach ($chmArray as $row) {
            $apartamento = new apartamento();
            $apartamento->read($row[id]);
            $retorno[$x] = $apartamento;
            $x++;
        }
        return $retorno;
    }
}
?>