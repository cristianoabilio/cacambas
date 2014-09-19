@extends('templates.main')

@section('content')

    @include('modules.caminhoes.form')

    <div class="tabs">
     <ul class="nav nav-tabs nav-tabs-center">
        <li class="active"><a href="#camin-lista">Lista de caminhões</a></li>
        <li><a href="#camin-manutencao">Manutenção</a></li>
      </ul>
    </div>
    <div class="panel">
        <div id="content" class="tab-content tab-active">

          <?php if(count($caminhoes) > 0){ ?>
          <div class="tab-pane active" id="camin-lista">
            <table id="tbl-caminhoes" class="table table-striped table-hover table-order">
              <thead>
                <tr>
                  <th>Caminhão<span class="caret"></span></th>
                  <th>Placa<span class="caret"></span></th>
                  <th>Ano<span class="caret"></span></th>
                  <th>Situação<span class="caret"></span></th>
                  <th>Manutenção<span class="caret"></span></th>
                  <th>Motorista (atual)<span class="caret"></span></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($caminhoes as $caminhao){ ?>
                <tr>
                  <td><?php echo $caminhao->marca?></td>
                  <td><?php echo $caminhao->placa?></td>
                  <td><?php echo $caminhao->modelo?></td>
                  <td class="text-success">Ativado</td>
                  <td>2/09/12 (140 dias)</td>
                  <td>Adão do Papelão</td>
                  <td></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <?php  }else{ ?>
            <p class="alert alert-info"><i class="fa fa-info-circle"></i> Não há caminhões cadastrados no momento.</p>
          <?php } ?>

          <div class="tab-pane" id="camin-manutencao">
            <table id="tbl-caminhoes" class="table table-striped table-hover table-order">
              <thead>
                <tr>
                  <th>Data Início<span class="caret"></span></th>
                  <th>Data Fim<span class="caret"></span></th>
                  <th>Caminhão<span class="caret"></span></th>
                  <th>Serviço<span class="caret"></span></th>
                  <th>Empresa<span class="caret"></span></th>
                  <th>Valor<span class="caret"></span></th>
                  <th>Pago<span class="caret"></span></th>
                  <th>Manutenção<span class="caret"></span></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>21/07/13</td>
                  <td class="text-danger">25/07/13</td>
                  <td>Mercedez Bens 003</td>
                  <td class="text-muted"><em>Não informado</em></td>
                  <td class="text-muted"><em>Não informado</em></td>
                  <td>250,00</td>
                  <td>
                    <label class="checkbox-inline">
                      <input type="checkbox" id="nao" value="option1" class="check-green" disabled="disabled"> Não
                    </label>
                  </td>
                  <td class="text-danger">Em andamento</td>
                  <td>
                    <button type="button" class="btn btn-default btn-sm btn-none"><i class="fa fa-pencil"></i><span class="btn-effect"> Editar</span></button>
                    <button type="button" class="btn btn-danger btn-sm btn-none"><i class="fa fa-trash-o"></i><span class="btn-effect"> Apagar</span></button>
                  </td>
                </tr>
                <tr>
                  <td>21/07/13</td>
                  <td>30/07/13</td>
                  <td>Mercedez Bens 001</td>
                  <td>Troca de Óleo</td>
                  <td>Posto Jabá</td>
                  <td>250,00</td>
                  <td class="text-success">
                    <label class="checkbox-inline">
                      <input type="checkbox" id="sim" value="option2" class="check-green" checked="checked"> Sim
                    </label>
                  </td>
                  <td class="text-success">Finalizada</td>
                  <td class="tdBtns">
                    <button type="button" class="btn btn-default btn-sm btn-none"><i class="fa fa-pencil"></i><span class="btn-effect"> Editar</span></button>
                    <button type="button" class="btn btn-danger btn-sm btn-none"><i class="fa fa-trash-o"></i><span class="btn-effect"> Apagar</span></button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
    </div>
 </div><!-- wrapper -->
</div><!-- rows-->
@stop