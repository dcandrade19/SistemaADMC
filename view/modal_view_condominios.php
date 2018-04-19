
<!-- Large modal -->

<div class="modal fade bd-example-modal-lg" tabindex="-1" id="modal_view_condominios" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      <div class="modal-body">
      <div class="col col-md-12">
      <i class="fas fa-building fa-3x"></i>
      <div class="view-head col-md-8">
      <h3> Condominio: <?=$nome?></h3>
      
      <div class="view-dados">
      
      <div  id="head-dados"><?=$status?> Endereço: <?=$endereco?> <span class="btns"><?=$btns?></span></div>
      
      
      </div>
      
      </div>
      </div>
      
      <hr>
      
      <h5 class="view-titulo">Blocos <?php echo '<span class="badge badge-light">'.count($blocos) .'</span>';?></h5>
      <?php if ($blocos_lista) {
          echo  '<div class="row">' .$blocos_lista .'</div>';
      } else {
          echo 'Este condominio não possui blocos cadastrados!';
          }?>
      
      <hr>
      
      <h5 class="view-titulo">Apartamentos <?php echo '<span class="badge badge-light">'. $qtd_apt .'</span>';?></h5>
       <?php if ($tabela_apartamentos) {
          echo $tabela_apartamentos;
      } else {
          echo 'Este condominio não possui apartamentos cadastrados!';
          }?>
      <hr>
      
      <h5 class="view-titulo">Moradores <?php echo '<span class="badge badge-light">'.$qtd_mor.'</span>';?></h5>
      <?php if ($tabela_moradores) {
          echo $tabela_moradores;
      } else {
          echo 'Este condominio não possui moradores cadastrados!';
          }?>
      </div>
    </div>
  </div>
</div>
