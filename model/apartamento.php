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
    
    function getStatusBadge(){
        if($this->status){
            return '<span class="badge badge-success">Ativado</span>';
        }else{
            return '<span class="badge badge-danger">Desativado</span>';
        }
    }
    
    function getNomeBloco($id_bloco){
        $blocos = bloco::getAll();
        $nome = null;
        foreach($blocos as $bloco){
            if($id_bloco == $bloco->getId()){
                $nome = $bloco->getNome();
            }
        }
        return $nome;
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
    
    static function getAll($status = 2){
        if ($status == 2) {
            $complemento = '';
        } else {
            $complemento = 'WHERE status = ' .$status;
        }
        $dbh = dataBase::getHandler();
        $result = $dbh->query("SELECT id FROM apartamentos $complemento ORDER BY id DESC");
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
    
    static function search($keyword = "", $status = 2){
        if ($status == 2) {
            $complemento = 'WHERE';
        } else {
            $complemento = 'WHERE status = ' .$status. ' AND';
            echo $status;
        }
        $dbh = dataBase::getHandler();
        $result = $dbh->query("SELECT id FROM apartamentos $complemento numero LIKE '%$keyword%' ORDER BY id DESC");
        
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

    static function doSelectCondominio(){
        $select = '<select required name="id_condominio" class="form-control"  required onChange="fetch_select(this.value);">';
        
        $condominios = condominio::getAll();
        if(count($condominios)){
            $select.= '<option value="" selected disabled hidden>Selecione uma opção</option>';
            foreach($condominios as $condominio){       
                $select.='<option value="'.$condominio->getId().'">'.$condominio->getNome().'</option>';
            }
        }else{
            $select.= '<option value="" selected disabled hidden>Nenhum apartamento cadastrado!</option>';
        }
        $select.='</select>';
        return $select;
    }
    
    static function getBlocoPorId($id){
        $dbh = dataBase::getHandler();
        $result = $dbh->query("SELECT * FROM blocos WHERE id_condominio = $id");
        $chmArray = $result->fetchAll(PDO::FETCH_ASSOC);
        $x=0;
        $retorno = null;
        foreach ($chmArray as $row) {
            $bloco = new bloco();
            $bloco->read($row['id']);
            $retorno[$x] = $bloco;
            $x++;
        }
        return $retorno;
    }
    
    static function doSelectBloco($id){
        $select = '<select required name="id_bloco" class="form-control" required onChange="fetch_select_apt(this.value);">';
        
        $blocos = apartamento::getBlocoPorId($id);
        if($blocos){
            if(count($blocos)){
                $select.= '<option value="" selected disabled hidden>Selecione uma opção</option>';
                foreach($blocos as $bloco){
                    $select.='<option value="'.$bloco->getId().'">'.$bloco->getNome().'</option>';
                }
            }
        }else{
            $select.= '<option value="" selected disabled hidden>Nenhum bloco cadastrado!</option>';
        }
        $select.='</select>';
        return $select;
    }

}
?>