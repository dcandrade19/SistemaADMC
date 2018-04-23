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

if($_POST[action]=="createupdate"){
    $funcionario = new funcionario();
    if($_POST[id]!='') $funcionario->read($_POST[id]);
    $funcionario->setNome($_POST[nome]);
    $funcionario->setStatus($_POST[status]);
    $funcionario->setCpf($_POST[cpf]);
    $funcionario->setId_funcao($_POST[id_funcao]);
    $funcionario->setId_condominio($_POST[id_condominio]);
    //$funcionario->setId_condominio($_POST[id_condominio]);
    $despesa = new despesa();
    $despesa->setTitulo($_POST[titulo]);
    $despesa->setDescricao($_POST[descricao]);
    $despesa->setValor($_POST[valor]);
    if($_POST[id]!=''){
        $funcionario->update();
        $texto = 'editado';
    }else{
        $despesa->create();
        $funcionario->setId_despesa($despesa->getId());
        $funcionario->create();
        $texto = 'salvo';
    }
    $res = '
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    Funcionario <strong>'.$funcionario->getNome().'</strong> '.$texto.' com sucesso!!!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>';
    
}elseif($_GET[action]=='delete'){
    $funcionario = new funcionario();
    $funcionario->read($_GET[id]);
    $nome_salvo = $funcionario->getNome();
    $funcionario->delete();
    $res = '
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    Funcionario <strong>'.$nome_salvo.'</strong> deletado com sucesso!!!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>';
}elseif($_GET[action]=='edit'){
    $funcionarioEdicao = new funcionario();
    $funcionarioEdicao->read($_GET[id]);
    $nome = $funcionarioEdicao->getNome();
    $status = $funcionarioEdicao->getStatus();
    $cpf = $funcionarioEdicao->getCpf();
    $id = $funcionarioEdicao->getId();
    echo '<script>
        $(document).ready(function(){
        $("#modal_funcionarios").modal();
        });
          </script>';
}

if($_POST[action]=='filtrar'){
    $funcionarios = funcionario::search($_POST[filtro],$modo);
    $qtd = sizeof($funcionarios);
    if ($qtd == 0) {
        $texto = 'Nenhum funcionario encontrado!!!';
        $qtd = null;
    }else if ($qtd == 1) {
        $texto = 'funcionario encontrado!!!';
    }else {
        $texto = 'funcionarios encontrados!!!';
    }
    $resf = '
    <div class="alert alert-info alert-dismissible fade show" role="alert">
    <strong>'.$qtd.'</strong> '.$texto. '
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>';
}else{
    $funcionarios = funcionario::getAll($modo);
    $qtd = sizeof($funcionarios);
    if(empty($res)) {
        $resf = '
    <div class="alert alert-dark alert-dismissible fade show" role="alert">
    Exibindo <strong>'.$qtd.'</strong> registros.
    </div>';
    }
    
}

if(sizeof($funcionarios)){
    $tb_head = '<table class="table lista-itens">
            <thead>
            <tr class="tr-head">
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Cpf</th>
            <th scope="col">Condominio</th>
            <th scope="col">Função</th>
            <th scope="col">Salario</th>
            <th scope="col">Status</th>
            <th scope="col">Opções</th>
            </tr>
            ';
    $tb_end = '</table>';
    foreach ($funcionarios as $funcionario) {
        $tb_content .= '</thead>
            <tbody>
            <tr><th scope="row">'.$funcionario->getId().'</th>
            <td>'.$funcionario->getNome().'</td>
            <td>'.$funcionario->getCpf().'</td>
            <td>'.$funcionario->getId_condominio().'</td>
            <td>'.$funcionario->getId_funcao().'</td>
            <td>'.$funcionario->getId_despesa().'</td>
            <td>'.$funcionario->getStatusBadge().'</td>
            <td>
            <a class="icone edit" href="?controller=funcionarios&action=edit&id='.
            $funcionario->getId().'"data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
            <a class="icone del" href="?controller=funcionarios&action=delete&id='.
            $funcionario->getId().'"data-toggle="tooltip" data-placement="top" title="Deletar"><i class="fas fa-trash-alt"></i></a> </td>
            </tr>
            </tbody>';
            
    }
    $tb = $tb_head .$tb_content .$tb_end;
}

if(sizeof($funcionarios)){
    foreach ($funcionarios as $funcionario) {
        $cond .= "<div class='col-xs-12 text-center'> <div class='btn-menu' onclick='location.href='?teste''> <i class='fas fa-user fa-3x'></i> <p>".
            $funcionario->getNome().
            "</p> <div class='mi-btn'>".
            "<a class='icone edit' href='?controller=funcionarios&action=edit&id=".
            $funcionario->getId()."'data-toggle='tooltip' data-placement='top' title='Editar'><i class='fas fa-edit'></i></a>".
            "<a class='icone del' href='?controller=funcionarios&action=delete&id=".
            $funcionario->getId()."'data-toggle='tooltip' data-placement='top' title='Deletar'><i class='fas fa-trash-alt'></i></a> </div></div>".$funcionario->getStatusBadge()."</div>";
            
    }
}

include "./view/menu.php";
?>