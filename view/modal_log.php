<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modal_log" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Log da Sessão</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php 
        if ($_SESSION['log']) {
            $log_sessao = $_SESSION['log'];
            $replace = array('&times;','!');
            $log_time = $_SESSION['time'];
           
            
            $log_sessao = array_reverse($log_sessao);
            $log_time = array_reverse($log_time);
            

            $log_head = '<table class="table tb-log ">
            <thead>
            <tr class="tr-head">
            <th scope="col">#</th>
            <th scope="col">Evento</th>
            <th scope="col">Data/Hora</th>
            </tr>
            </thead>
            <tbody>';
            
            $x = 0;
            foreach ($log_sessao as $ind => $log) {
                $log_body .= '<tr><th scope="row">'.$ind.'</th>
                                 <td>'.str_replace($replace,'',strip_tags($log, '<strong>')).'</td>
                                 <td>'.$log_time[$x].'</td></tr>';
                $x++;
            }
            
            $log_table = $log_head .$log_body .'
            </tbody>
            </table>';
            
            echo $log_table;
        }
        
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary">Salvar log</button>
      </div>
    </div>
  </div>
</div>