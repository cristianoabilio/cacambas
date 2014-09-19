<!-- Modal -->
<div class="modal modal-sm fade" id="modal-caminhoes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content modal-content-sm">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
        <h3 class="modal-title" id="myModalLabel">Cadastrar Caminhão</h3>
      </div>
      <form id="frmCaminhoes" action="<?php echo action('CaminhoesController@store')?>" method="post" role="form" data-parsley-validate>
      <div class="modal-body">

          <fieldset>
            <div class="row">
              <div class="form-group col-md-8 no-padding-left">
                <label for="nome-marca">Nome / Marca:  </label>
                <input type="text" name="marca" id="nome-marca" class="form-control input-sm" required>
              </div>
              <div class="form-group col-md-4 no-padding-right">
                <label for="ano">Ano:  </label>
                <input type="text" name="modelo" id="ano" class="form-control" required>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6 no-padding-left no-margin-bottom">
                <label for="placa">Placa: </label>
                <input type="text" name="placa" id="placa" class="form-control" required>
              </div>
              <div class="form-group col-md-6 no-padding-right no-margin-bottom">
                <label for="motorista">Motorista:  </label>
                <select id="motorista" class="form-control selectpicker">
                  <option>Selecione</option>
                  <option>José</option>
                  <option>Pedro</option>
                </select>
              </div>
            </div>
          </fieldset>

      </div>
      <div class="modal-footer">
        <button type="submit" id="bt-enviar" class="btn btn-success">Cadastrar &rsaquo;</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->