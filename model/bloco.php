<?php
include_once "database.php";

class bloco {
    
    private $id = 0;
    private $nome = '';
    private $status = '';
    private $id_condominio = '';
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
    
    function setId_condominio($id_condominio){
        $this->id_condominio = $id_condominio;
    }
    
    function getId_condominio(){
        return $this->id_condominio;
    }
    
    function getNomeCondominio($id_condominio){
        $condominios = condominio::getAll();
        $nome = null;
        foreach($condominios as $condominio){
            if($id_condominio == $condominio->getId()){
                $nome = $condominio->getNome();
            }
        }
        return $nome;
    }
    
    
    function create(){
        $this->dbh->exec("INSERT INTO blocos(nome,status,id_condominio) VALUES ('$this->nome','$this->status','$this->id_condominio')");
        $lastId = $this->dbh->lastInsertId();
        $this->read($lastId);
    }
    
    function read($id){
        $result = $this->dbh->query("SELECT * FROM blocos WHERE id = $id");
        $usrArray = $result->fetchAll(PDO::FETCH_ASSOC);
        $this->setId($usrArray[0]['id']);
        $this->setNome($usrArray[0]['nome']);
        $this->setStatus($usrArray[0]['status']);
        $this->setId_condominio($usrArray[0]['id_condominio']);
    }
    
    function update(){
        $this->dbh->exec("UPDATE blocos SET nome='$this->nome',status='$this->status',id_condominio='$this->id_condominio' WHERE id = $this->id");
        $this->read($this->id);
    }
    
    function delete(){
        $this->dbh->exec("DELETE FROM blocos WHERE id = $this->id");
        $this->id = 0; // Remover referência
    }
    
    static function getAll($status = 1){
        $dbh = dataBase::getHandler();
        $result = $dbh->query("SELECT id FROM blocos WHERE status = $status ORDER BY id DESC");
        $chmArray = $result->fetchAll(PDO::FETCH_ASSOC);
        $x=0;
        foreach ($chmArray as $row) {
            $bloco = new bloco();
            $bloco->read($row[id]);
            $retorno[$x] = $bloco;
            $x++;
        }
        return $retorno;
    }
    
    static function search($keyword = "", $status = 1){
        $dbh = dataBase::getHandler();
        $result = $dbh->query("SELECT id FROM blocos WHERE status = $status AND nome LIKE '%$keyword%' ORDER BY id DESC");
        
        $chmArray = $result->fetchAll(PDO::FETCH_ASSOC);
        $x=0;
        foreach ($chmArray as $row) {
            $bloco = new bloco();
            $bloco->read($row[id]);
            $retorno[$x] = $bloco;
            $x++;
        }
        return $retorno;
    }
    
    
    static function doSelect(){
        $select = '<select required name="id_condominio" class="form-control" required>';
        
        $condominios = condominio::getAll();
        if(count($condominios)){
            $select.= '<option value="" selected disabled hidden>Selecione uma opção</option>';
            foreach($condominios as $condominio){
                $select.='<option value="'.$condominio->getId().'">'.$condominio->getNome().'</option>';
            }
        }else{
            $select.= '<option value="" selected disabled hidden>Nenhum condomínio cadastrado!</option>';
        }
        $select.='</select>';
        return $select;
    }
}
?>