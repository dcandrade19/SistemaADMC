<?php
$modo = 2;
if ($_POST[select_opcoes]) {
    if ($_POST[select_opcoes] == 'Todos') {
        $modo = 2;
    } elseif ($_POST[select_opcoes] == 'Ativados'){
        $modo = 1;
    } elseif ($_POST[select_opcoes] == 'Desativados'){
        $modo = 0;
    }
}

if($_POST['action']=="createupdate"){
    $condominio = new condominio();
    if($_POST['id']!='') $condominio->read($_POST['id']);
    $condominio->setNome($_POST[nome]);
    $condominio->setStatus($_POST[status]);
    $condominio->setEndereco($_POST[endereco]);
    if($_POST['id']!=''){
        $condominio->update();
        $texto = 'editado';
    }else{
        $condominio->create();
        $texto = 'salvo';
    }
    $res = '
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    Condominio <strong>'.$condominio->getNome().' </strong>'.$texto.' com sucesso!!!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>';
    
}elseif($_GET[action]=='delete'){
    $condominio = new condominio();
    $condominio->read($_GET[id]);
    $nome_salvo = $condominio->getNome();
    $condominio->delete();
    
    //CRIAR MENSAGEM CASO EXISTA BLOCO CADASTRADO
    $res = '
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    Condominio <strong>'.$nome_salvo.'</strong> deletado com sucesso!!!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>';
}elseif($_GET[action]=='edit'){
    $condominioEdicao = new condominio();
    $condominioEdicao->read($_GET[id]);
    $nome = $condominioEdicao->getNome();
    $status = $condominioEdicao->getStatus();
    $endereco = $condominioEdicao->getEndereco();
    $id = $condominioEdicao->getId();
    echo '<script>
        $(document).ready(function(){
        $("#modal_condominios").modal();
        });
          </script>';
}elseif($_GET[action]=='view'){
    $condominio = new condominio();
    $condominio->read($_GET[id]);
    $nome = $condominio->getNome();
    $status = $condominio->getStatusBadge();
    $endereco = $condominio->getEndereco();
    $id = $condominio->getId();
    $qtd_apt = 0;
    $qtd_mor = 0;
    $btns = '<a class="icone edit" href="?controller=condominios&action=edit&id='.
            $condominio->getId().'"data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
            <a class="icone del" href="?controller=condominios&action=delete&id='.
            $condominio->getId().'"data-toggle="tooltip" data-placement="top" title="Deletar"><i class="fas fa-trash-alt"></i></a>';
    $blocos = apartamento::getBlocoPorId($id);
    $apartamentos_lista = array();
    $moradores_lista = array();
    foreach ($blocos as $bloco) {
       $apartamentos = morador::getApartamentoPorId($bloco->getId());
       foreach ($apartamentos as $apartamento) {
           array_push($apartamentos_lista, $apartamento);
           $qtd_apt++;
       }
       
    }
    foreach ($apartamentos_lista as $apartamento) {  
       $moradores = morador::getMoradoresPorId($apartamento->getId()); 
       foreach ($moradores as $morador) {
           array_push($moradores_lista, $morador);
           $qtd_mor++;
       }
       
    }

    if(sizeof($blocos)){
        foreach ($blocos as $bloco) {
            $blocos_lista .= "<div class='col-xs-12 text-center'> <div class='btn-menu' onclick='location.href='?teste''> <i class='fas fa-th-large fa-3x'></i> <p>".
                $bloco->getNome().
                "</p> <div class='mi-btn'>".
                "<a class='icone edit' href='?controller=blocos&action=edit&id=".
                $bloco->getId()."'data-toggle='tooltip' data-placement='top' title='Editar'><i class='fas fa-edit'></i></a>".
                "<a class='icone del' href='?controller=blocos&action=delete&id=".
                $bloco->getId()."'data-toggle='tooltip' data-placement='top' title='Deletar'><i class='fas fa-trash-alt'></i></a> </div></div>".$bloco->getStatusBadge()."</div>";
                
        }
    }
    
   if(sizeof($apartamentos_lista)){
        $tb_h = '<table class="table">
            <thead>
            <tr class="tr-head">
            <th scope="col">#</th>
            <th scope="col">Numero</th>
            <th scope="col">Bloco</th>
            <th scope="col">Status</th>
            <th scope="col">Opções</th>
            </tr>
            ';
        $tb_e = '</table>';
        foreach ($apartamentos_lista as $apartamento) {
            $tb_c .= '</thead>
            <tbody>
            <tr><th scope="row">'.$apartamento->getId().'</th>
            <td>'.$apartamento->getNumero().'</td>
            <td>'.$apartamento->getNomeBloco($apartamento->getId_bloco()).'</td>
            <td>'.$apartamento->getStatusBadge().'</td>
            <td>
            <a class="icone edit" href="?controller=apartamentos&action=edit&id='.
            $apartamento->getId().'"data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
            <a class="icone del" href="?controller=apartamentos&action=delete&id='.
            $apartamento->getId().'"data-toggle="tooltip" data-placement="top" title="Deletar"><i class="fas fa-trash-alt"></i></a> </td>
            </tr>
            </tbody>';
            
        }
        $tabela_apartamentos = $tb_h .$tb_c .$tb_e;
    }
   
    if(sizeof($moradores_lista)){
        $tb_he = '<table class="table">
            <thead>
            <tr class="tr-head">
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Cpf</th>
            <th scope="col">Apt</th>
            <th scope="col">Usuario</th>
            <th scope="col">Tipo</th>
            <th scope="col">Login</th>
            <th scope="col">Status</th>
            <th scope="col">Opções</th>
            </tr>
            ';
    $tb_en = '</table>';
    foreach ($moradores_lista as $morador) {
        $usuario = $morador->getUsuario($morador->getId_usuario());
        $login_u = $usuario->getLogin();
        $tipo = $usuario->getTipo();
        $status_usuario = $usuario->getStatusBadge();
        $tb_co .= '</thead>
            <tbody>
            <tr><th scope="row">'.$morador->getId().'</th>
            <td>'.$morador->getNome().'</td>
            <td>'.$morador->getCpf().'</td>
            <td>'.$morador->getNumeroApartamento($morador->getId_apartamento()).'</td>
            <td>'.$login_u.'</td>
            <td>'.$tipo.'</td>
            <td>'.$status_usuario.'</td>
            <td>'.$morador->getStatusBadge().'</td>
            <td>
            <a class="icone edit" href="?controller=moradores&action=edit&id='.
            $morador->getId().'"data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
            <a class="icone del" href="?controller=moradores&action=delete&id='.
            $morador->getId().'"data-toggle="tooltip" data-placement="top" title="Deletar"><i class="fas fa-trash-alt"></i></a> </td>
            </tr>
            </tbody>';
            
        }
        $tabela_moradores = $tb_he .$tb_co .$tb_en;
    }
    echo '<script>
        $(document).ready(function(){
        $("#modal_view_condominios").modal();
        });
          </script>';
}

if($_POST[action]=='filtrar'){
    $condominios = condominio::search($_POST[filtro],$modo);
    $qtd = sizeof($condominios);
    if ($qtd == 0) {
        $texto = 'Nenhum condominio encontrado!!!';
        $qtd = null;
    }else if ($qtd == 1) {
        $texto = 'condominio encontrado!!!';
    }else {
        $texto = 'condominios encontrados!!!';
    }
    $resf = '
    <div class="alert alert-info alert-dismissible fade show" role="alert">
    <strong>'.$qtd.'</strong> '.$texto. '
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>';
}else{
    $condominios = condominio::getAll($modo);
    $qtd = sizeof($condominios);
    if(empty($res)) {
        $resf = '
    <div class="alert alert-dark alert-dismissible fade show" role="alert">
    Exibindo <strong>'.$qtd.'</strong> registros.
    </div>';
    }
    
}

if(sizeof($condominios)){
    $tb_head = '<table class="table lista-itens">
            <thead>
            <tr class="tr-head">
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Endereço</th>
            <th scope="col">Status</th>
            <th scope="col">Opções</th>
            </tr>
            ';
    $tb_end = '</table>';
    foreach ($condominios as $condominio) {
        $tb_content .= '</thead>
            <tbody>
            <tr><th scope="row">'.$condominio->getId().'</th>
            <td>'.$condominio->getNome().'</td>
            <td>'.$condominio->getEndereco().'</td>
            <td>'.$condominio->getStatusBadge().'</td>
            <td><a class="icone view" href="?controller=condominios&action=view&id='.
            $condominio->getId().'"data-toggle="tooltip" data-placement="top" title="Detalhes"><i class="fas fa-eye"></i></a>
            <a class="icone edit" href="?controller=condominios&action=edit&id='.
            $condominio->getId().'"data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
            <a class="icone del" href="?controller=condominios&action=delete&id='.
            $condominio->getId().'"data-toggle="tooltip" data-placement="top" title="Deletar"><i class="fas fa-trash-alt"></i></a> </td>
            </tr>
            </tbody>';
            
    }
    $cond = $tb_head .$tb_content .$tb_end;
}

if(sizeof($condominios)){
    foreach ($condominios as $condominio) {
        $tb .= "<div class='col-xs-12 text-center'> <div class='btn-menu' onclick='location.href='?teste''> <i class='far fa-building fa-3x'></i> <p>".
            $condominio->getNome().
            "</p> <div class='mi-btn'> <a class='icone view' href='?controller=condominios&action=view&id=".
            $condominio->getId()."'data-toggle='tooltip' data-placement='top' title='Detalhes'><i class='fas fa-eye'></i></a>".
            "<a class='icone edit' href='?controller=condominios&action=edit&id=".
            $condominio->getId()."'data-toggle='tooltip' data-placement='top' title='Editar'><i class='fas fa-edit'></i></a>".
            "<a class='icone del' href='?controller=condominios&action=delete&id=".
            $condominio->getId()."'data-toggle='tooltip' data-placement='top' title='Deletar'><i class='fas fa-trash-alt'></i></a> </div></div>".$condominio->getStatusBadge()."</div>";
            
    }
}

include "./view/menu.php";
?>