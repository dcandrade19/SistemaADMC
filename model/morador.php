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
        if($this->status){
            return 'Ativado';
        }else{
            return 'Desativado';
        }
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
    
    function getNumeroApartamento($id_apartamento){
        $apartamentos = apartamento::getAll();
        $numero = null;
        foreach($apartamentos as $apartamento){
            if($id_apartamento == $apartamento->getId()){
                $numero = $apartamento->getNumero();
            }
        }
        return $numero;
    }
    
    function create(){
        $this->dbh->exec("INSERT INTO moradores(nome,cpf,status,id_apartamento,id_usuario) VALUES ('$this->nome','$this->cpf','$this->status','$this->id_apartamento','$this->id_usuario')");       
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
    
    static function getAll($status = 1){
        $dbh = dataBase::getHandler();
        $result = $dbh->query("SELECT id FROM moradores WHERE status = $status ORDER BY id DESC");
        $chmArray = $result->fetchAll(PDO::FETCH_ASSOC);
        $x=0;
        foreach ($chmArray as $row) {
            $morador = new morador();
            $morador->read($row[id]);
            $retorno[$x] = $morador;
            $x++;
        }
        return $retorno;
    }
    
    static function search($keyword = "", $status = 1){
        $dbh = dataBase::getHandler();
        $result = $dbh->query("SELECT id FROM moradores WHERE status = $status AND nome LIKE '%$keyword%' ORDER BY id DESC");
        
        $chmArray = $result->fetchAll(PDO::FETCH_ASSOC);
        $x=0;
        foreach ($chmArray as $row) {
            $morador = new morador();
            $morador->read($row[id]);
            $retorno[$x] = $morador;
            $x++;
        }
        return $retorno;
    }
    
    static function getApartamentoPorId($id){
        $dbh = dataBase::getHandler();
        $result = $dbh->query("SELECT * FROM apartamentos WHERE id_bloco = $id");
        $chmArray = $result->fetchAll(PDO::FETCH_ASSOC);
        $x=0;
        $retorno = null;
        foreach ($chmArray as $row) {
            $apartamento = new apartamento();
            $apartamento->read($row['id']);
            $retorno[$x] = $apartamento;
            $x++;
        }
        return $retorno;
    }
    
    static function doSelectApartamento($id){
        $select = '<select required name="id_apartamento" class="form-control" required>';
        
        $apartamentos = morador::getApartamentoPorId($id);
        if($apartamentos){
            if(count($apartamentos)){
                $select.= '<option value="" selected disabled hidden>Selecione uma opção</option>';
                foreach($apartamentos as $apartamento){
                    $select.='<option value="'.$apartamento->getId().'">'.$apartamento->getNumero().'</option>';
                }
            }
        }else{
            $select.= '<option value="" selected disabled hidden>Nenhum apartamento cadastrado!</option>';
        }
        $select.='</select>';
        return $select;
    }
    
    static function getMoradoresPorId($id){
        $dbh = dataBase::getHandler();
        $result = $dbh->query("SELECT * FROM moradores WHERE id_apartamento = $id");
        $chmArray = $result->fetchAll(PDO::FETCH_ASSOC);
        $x=0;
        $retorno = null;
        foreach ($chmArray as $row) {
            $morador = new morador();
            $morador->read($row['id']);
            $retorno[$x] = $morador;
            $x++;
        }
        return $retorno;
    }
    
}
?>