@extends('templates.main')

@section('content')

@include('modules.cacambas.modal')

<div class="tabs getFixedTab">
 <ul class="nav nav-tabs nav-tabs-center">
  <li class="active"><a href="#cacamba-lista" Class="tab-lista">Lista de caçambas</a></li>
  <li><a href="#cacamba-cadastra" Class="tab-cadastrar">Cadastrar caçamba</a></li>
  <li><a href="#cacamba-manutencao" Class="tab-manutencao">Manutenção</a></li>
</ul>
</div>
<div id="content" class="tab-content">
  <div class="tab-pane active" id="cacamba-lista">
    <table id="tbl-caminhoes" class="table table-striped table-hover table-order">
      <thead>
        <tr>
          <th>Número<span class="caret"></span></th>
          <th>Tipo<span class="caret"></span></th>
          <th>Tamanho<span class="caret"></span></th>
          <th>Valor Base<span class="caret"></span></th>
          <th>Manutenção<span class="caret"></span></th>
          <th>Situação<span class="caret"></span></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1030</td>
          <td>Construção</td>
          <td>5 m³</td>
          <td>250,00</td>
          <td>12/09/2012</td>
          <td class="text-success">Colocada</td>
          <td class="tdBtns">
            <button type="button" class="btn btn-default btn-sm btn-none" ><i class="fa fa-share"></i><span class="btn-effect"> Salvar</span></button>
            <button type="button" class="btn btn-default btn-sm btn-none" ><i class="fa fa-pencil"></i><span class="btn-effect"> Editar</span></button>
            <button type="button" class="btn btn-danger btn-sm btn-none"><i class="fa fa-trash-o"></i><span class="btn-effect"> Apagar</span></button>
          </td>
        </tr>
        <tr>
          <td>1030</td>
          <td>Construção</td>
          <td>5 m³</td>
          <td>250,00</td>
          <td>12/09/2012</td>
          <td class="text-primary">A colocar</td>
          <td>
            <button type="button" class="btn btn-default btn-sm btn-none" ><i class="fa fa-share"></i><span class="btn-effect"> Salvar</span></button>
            <button type="button" class="btn btn-default btn-sm btn-none" ><i class="fa fa-pencil"></i><span class="btn-effect"> Editar</span></button>
            <button type="button" class="btn btn-danger btn-sm btn-none"><i class="fa fa-trash-o"></i><span class="btn-effect"> Apagar</span></button>
          </td>
        </tr>
        <tr class="success">
          <td>
            <input class="form-control input-sizes" type="text" placeholder="1030">
          </td>
          <td>
            <div class="form-group col-md-8 no-margin no-padding">
              <select id="motorista" class="form-control selectpicker">
                <option>Construção</option>
                <option>José</option>
                <option>Pedro</option>
              </select>
            </div>
          </td>
          <td>
            <input class="form-control input-sizes" type="text" placeholder="5"> m3
          </td>
          <td>
            <input class="form-control input-sizes" type="text" placeholder="250,00">
          </td>
          <td>12/09/2012</td>
          <td class="text-primary">A colocar</td>
          <td>
            <button type="button" class="btn btn-success btn-sm btn-none"><i class="fa fa-check"> </i><span class="btn-effect"> Salvar</span></button>
            <button type="button" class="btn btn-default btn-sm btn-none"><i class="fa fa-reply"> </i><span class="btn-effect"> Cancelar</span></button>
          </td>
        </tr>
        <tr class="success">
          <td>
            <input class="form-control input-sizes" type="text" placeholder="PRA">
            <input class="form-control input-sizes" type="text" placeholder="5002">
            <input class="form-control input-sizes" type="text" placeholder="T">
          </td>
          <td>
            <div class="form-group col-md-8 no-margin no-padding">
              <select id="motorista" class="form-control selectpicker">
                <option>Construção</option>
                <option>José</option>
                <option>Pedro</option>
              </select>
            </div>
          </td>
          <td>
            <input class="form-control input-sizes" type="text" placeholder="5"> m3
          </td>
          <td>
            <input class="form-control input-sizes" type="text" placeholder="250,00">
          </td>
          <td>12/09/2012</td>
          <td class="text-primary">A colocar</td>
          <td>
            <button type="button" class="btn btn-success btn-sm btn-none"><i class="fa fa-check"> </i><span class="btn-effect"> Salvar</span></button>
            <button type="button" class="btn btn-default btn-sm btn-none"><i class="fa fa-reply"> </i><span class="btn-effect"> Cancelar</span></button>
          </td>
        </tr>
        <tr>
          <td>1030</td>
          <td>Construção</td>
          <td>5 m³</td>
          <td>250,00</td>
          <td>12/09/2012</td>
          <td class="text-muted">Livre</td>
          <td>
            <button type="button" class="btn btn-default btn-sm btn-none" ><i class="fa fa-share"></i><span class="btn-effect"> Salvar</span></button>
            <button type="button" class="btn btn-default btn-sm btn-none" ><i class="fa fa-pencil"></i><span class="btn-effect"> Editar</span></button>
            <button type="button" class="btn btn-danger btn-sm btn-none"><i class="fa fa-trash-o"></i><span class="btn-effect"> Apagar</span></button>
          </td>
        </tr>
        <tr>
          <td>1030</td>
          <td>Construção</td>
          <td>5 m³</td>
          <td>250,00</td>
          <td>12/09/2012</td>
          <td>Em manutenção</td>
          <td>
            <button type="button" class="btn btn-default btn-sm btn-none" ><i class="fa fa-share"></i><span class="btn-effect"> Salvar</span></button>
            <button type="button" class="btn btn-default btn-sm btn-none" ><i class="fa fa-pencil"></i><span class="btn-effect"> Editar</span></button>
            <button type="button" class="btn btn-danger btn-sm btn-none"><i class="fa fa-trash-o"></i><span class="btn-effect"> Apagar</span></button>
          </td>
        </tr>
        <tr>
          <td>1030</td>
          <td>Construção</td>
          <td>5 m³</td>
          <td>250,00</td>
          <td>12/09/2012</td>
          <td class="text-danger">Desativado</td>
          <td>
            <button type="button" class="btn btn-default btn-sm btn-none" ><i class="fa fa-share"></i><span class="btn-effect"> Salvar</span></button>
            <button type="button" class="btn btn-default btn-sm btn-none" ><i class="fa fa-pencil"></i><span class="btn-effect"> Editar</span></button>
            <button type="button" class="btn btn-danger btn-sm btn-none"><i class="fa fa-trash-o"></i><span class="btn-effect"> Apagar</span></button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="tab-pane" id="cacamba-cadastra">
    <div class="col-md-12">
      <div class="panel panel-default panel-cacambas">
        <div class="panel panel-body">
          <!-- aqui form -->
        </div>
        <div class="panel-footer">
          <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Cadastrar</button>
        </div>
      </div>
    </div>
  </div>
  <div class="tab-pane" id="cacamba-manutencao">
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
            <button type="button" class="btn btn-default btn-sm btn-none"><i class="fa fa-pencil"></i></button>
            <button type="button" class="btn btn-danger btn-sm btn-none"><i class="fa fa-trash-o"></i></button>
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
          <td>
            <button type="button" class="btn btn-default btn-sm btn-none"><i class="fa fa-pencil"></i></button>
            <button type="button" class="btn btn-danger btn-sm btn-none"><i class="fa fa-trash-o"></i></button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@stop