    <div class="tabs getFixedTab">
     <ul class="nav nav-tabs nav-locacoes">
        <li class="active"><a class="tab-colocar" href="#mot-lista"><i class="fa fa-map-marker fa-lg"></i> Colocar</a></li>
        <li><a class="tab-colocadas" href="#mot-cadastra"><i class="fa fa-map-marker fa-lg"></i> Colocadas</a></li>
        <li><a class="tab-trocar" href="#mot-ordens"><i class="fa fa-map-marker fa-lg"></i> Trocar</a></li>
        <li><a class="tab-retirar" href="#mot-produtividade"><i class="fa fa-map-marker fa-lg"></i> Retirar</a></li>
        <form id="search-tables" class="navbar-form navbar-left search-tabs" role="search">
          <i class="ico-lupa fa fa-search fa-lg"></i>
          <div class="form-group">
            <input type="text" class="form-control txtSearch" placeholder="Pesquisar ...">
          </div>
          <button type="submit" class="btn btn-default limpar"><i class="fa fa-times-circle"></i> Limpar</button>
        </form>
        <div class="pull-right">
          <ul class="nav nav-print-date">
            <li><button class="btn btn-default btn-sm"><i class="fa fa-print"></i></button></li>
            <li><a href="#">Esta semana<span class="caret"></span></a></li>
          </ul>
        </div>
      </ul>
    </div>
      <div id="content" class="tab-content">
          <div class="tab-pane active table-responsive" id="mot-lista">
            <table id="tbl-caminhoes" class="table table-striped table-hover table-order">
                <thead >
                  <tr>
                    <th>Cliente<span class="caret"></span></th>
                    <th>Endereço<span class="caret"></span></th>
                    <th>Colocar<span class="caret"></span></th>
                    <th>Valor<span class="caret"></span></th>
                    <th>Pago<span class="caret"></span></th>
                    <th></th>
                    <th>Motorista<span class="caret"></span></th>
                    <th>Caçamba<span class="caret"></span></th>
                  </tr>
                </thead>
              <tbody>
                <tr class="success">
                  <td colspan="8">
                    <i class="fa fa-check-circle"></i> As alterações desta locação foram salvas!
                    <a href="#" class="btn btn-link link-gray tClose"><i class="fa fa-times-circle"></i> Fechar</a>
                  </td>
                </tr>
                <tr class="success">
                  <td colspan="8">
                    <i class="fa fa-check-circle"></i> A caçamba foi colocada com sucesso!<button type="button" class="btn btn-link">Ver lista de colocadas</button>
                   <a href="#" class="btn btn-link link-gray tClose"><i class="fa fa-times-circle"></i> Fechar</a>
                  </td>
                </tr>
                <tr class="warning">
                  <td colspan="8">
                    <i class="fa fa-exclamation-triangle"></i> Por favor, selecione o motorista e informe a caçamba!
                    <a href="#" class="btn btn-link link-gray tClose"><i class="fa fa-times-circle"></i> Fechar</a>
                  </td>
                </tr>
                <tr class="danger">
                  <td colspan="8">
                    <i class="fa fa-exclamation-triangle"></i> Você realmente quer apagar esta locação?
                    <button type="button" class="btn btn-danger btn-sm">Sim</button>
                    <button type="button" class="btn btn-default btn-sm">Não</button>
                   <a href="#" class="btn btn-link link-gray tClose"><i class="fa fa-times-circle"></i> Fechar</a>
                  </td>
                </tr>
                <tr class="info">
                  <td colspan="8">
                    <i class="fa fa-info-circle"></i> Colocar caçamba na frente do portão, ao 12h.
                    <a href="#" class="btn btn-link link-gray tClose"><i class="fa fa-times-circle"></i> Fechar</a>
                  </td>
                </tr>
                <tr>
                  <td colspan="8">
                    <p class="data-itens-filtro">18/07/2013</p>
                  </td>
                </tr>
                <tr>
                  <td>Paulo</td>
                  <td>Av. Sete de Setembro, 2346, Centro</td>
                  <td class="text-danger">15/07/2013</td>
                  <td>250,00</td>
                  <td class="text-success">
                    <label class="checkbox-inline">
                      <input type="checkbox" id="sim" value="option2" class="check-green" checked="checked"> Sim
                    </label>
                  </td>
                  <td><a href="#" class="tTip obs" data-placement="right" data-toggle="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus, praesentium aperiam odio enim nostrum expedita aliquam molestias ab laboriosam commodi. Quis, adipisci amet hic cumque voluptates quas incidunt asperiores ut!">OBS &rsaquo;</a></td>
                  <td>Maurício <br /> <span class="text-primary aguardando">Aguardando ...</span></td>
                  <td>-----------</a></td>
                </tr>
                <tr>
                  <td>Paula Maria</td>
                  <td>Av. Sete de Setembro, 2346, Centro</td>
                  <td class="text-danger">15/07/2013</td>
                  <td>250,00</td>
                  <td class="text-danger">
                    <label class="checkbox-inline">
                      <input type="checkbox" id="nao" value="option1" class="check-green" disabled="disabled"> Não
                    </label>
                  </td>
                  <td><a href="#" class="tTip obs" data-placement="right" data-toggle="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus, praesentium aperiam odio enim nostrum expedita aliquam molestias ab laboriosam commodi. Quis, adipisci amet hic cumque voluptates quas incidunt asperiores ut!">OBS &rsaquo;</a></td>
                  <td>
                    <div class="form-group col-md-8 no-margin no-padding">
                        <select id="motorista" class="form-control selectpicker" data-live-search="true">
                          <option>Selecione</option>
                          <option>José</option>
                          <option>Pedro</option>
                        </select>
                    </div>
                  </td>
                 <td class="tdBtns">
                    <div class="col-md-4 form-group no-margin-bottom no-padding-left">
                      <input class="form-control" type="text" placeholder="Digite ..."></div>
                      <button type="button" id="btnColocar" class="btn btn-primary btn-sm btn-none">Colocar</i></button>
                      <button type="button" class="btn btn-default btn-sm btn-none"><i class="fa fa-pencil"> </i><span class="btn-effect"> Alterar</span></button>
                      <button type="button" class="btn btn-danger btn-sm btn-none"><i class="fa fa-trash-o"> </i><span class="btn-effect"> Apagar</span></button>
                  </td>
                </tr>
                <tr class="success">
                  <td>Paulo</td>
                  <td colspan="3"><input class="form-control" type="text" placeholder="Av. Sete de Setembro, 2346, Centro"></td>
                  <td class="text-success">
                    <label class="checkbox-inline">
                      <input type="checkbox" id="sim" value="option2" class="check-green" checked="checked"> Sim
                    </label>
                  </td>
                  <td><a href="#" class="tTip obs" data-placement="right" data-toggle="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus, praesentium aperiam odio enim nostrum expedita aliquam molestias ab laboriosam commodi. Quis, adipisci amet hic cumque voluptates quas incidunt asperiores ut!">OBS &rsaquo;</a></td>
                  <td>
                    <div class="form-group col-md-8 no-margin no-padding">
                        <select id="motorista" class="form-control selectpicker">
                          <option>Selecione</option>
                          <option>José</option>
                          <option>Pedro</option>
                        </select>
                    </div>
                  </td>
                  <td class="tdBtns">
                    <div class="col-md-4 form-group no-margin-bottom no-padding-left">
                      <input class="form-control" type="text" placeholder="Digite ..."></div>
                      <button type="button" class="btn btn-success btn-sm btn-none"><i class="fa fa-check"> </i><span class="btn-effect"> Salvar</span></button>
                      <button type="button" class="btn btn-default btn-sm btn-none"><i class="fa fa-reply"> </i><span class="btn-effect"> Cancelar</span></button>
                  </td>
                </tr>
              </tbody>
            </table>
            <p><a href="#" class="btn btn-link mais-clientes">Mostrar mais clientes <span class="caret caret-blue"></span></a></p>
          </div>
          <div class="tab-pane" id="mot-cadastra">
            <table id="tbl-caminhoes" class="table table-striped table-hover table-order">
              <thead>
                <tr>
                  <th>Cliente<span class="caret"></span></th>
                  <th>Endereço<span class="caret"></span></th>
                  <th>Colocadas<span class="caret"></span></th>
                  <th>Situação<span class="caret"></span></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Paulo Roberto Martins</td>
                  <td>Av. Sete de Setembro, 2346, Centro</td>
                  <td><span class="text-success num-colocadas"><strong>3</strong> </span>caçambas</td>
                  <td><div class="badge badges-situacao"><span class="badges-leg retirar"></span><span class="num">2</span> a Retirar</div><div class="badge badges-situacao"><span class="badges-leg trocar"></span><span class="num">1</span> a Trocar</div></td>
                  <td><button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-down"> </i></button></td>
                </tr>
                <tr class="sub">
                  <td colspan="5">
                    <table class="table">
                      <thead>
                        <tr>
                          <th></th>
                          <th width="180">Caçamba</th>
                          <th width="180">Colocada</th>
                          <th width="180">A retirar</th>
                          <th width="180">Valor</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="td-vazia"></td>
                          <td>355 (Construção 3m)</td>
                          <td class="text-danger">12/06/13 <span class="badge badge-danger">Vencida</span></td>
                          <td>17/06/13</td>
                          <td>280,00</td>
                          <td>
                            <button type="button" class="btn btn-default btn-sm btn-none"><i class="fa fa-pencil"> </i><span class="btn-effect"> Alterar</span></button>
                            <button type="button" class="btn btn-danger btn-sm btn-none"><i class="fa fa-trash-o"> </i><span class="btn-effect"> Apagar</span></button>
                          </td>
                        </tr>
                        <tr>
                          <td class="td-vazia"></td>
                          <td>355 (Construção 3m)</td>
                          <td>12/06/13</td>
                          <td>17/06/13</td>
                          <td>280,00</td>
                          <td>
                            <button type="button" class="btn btn-default btn-sm btn-none"><i class="fa fa-pencil"> </i><span class="btn-effect"> Alterar</span></button>
                            <button type="button" class="btn btn-danger btn-sm btn-none"><i class="fa fa-trash-o"> </i><span class="btn-effect"> Apagar</span></button>
                          </td>
                        </tr>
                        <tr>
                          <td class="td-vazia"></td>
                          <td>355 (Construção 3m)</td>
                          <td>12/06/13</td>
                          <td>17/06/13</td>
                          <td>280,00</td>
                          <td class="tdBtns">
                            <button type="button" class="btn btn-default btn-sm btn-none"><i class="fa fa-pencil"> </i><span class="btn-effect"> Alterar</span></button>
                            <button type="button" class="btn btn-danger btn-sm btn-none"><i class="fa fa-trash-o"> </i><span class="btn-effect"> Apagar</span></button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="tab-pane" id="mot-ordens">
            <table id="tbl-caminhoes" class="table table-striped table-hover table-order">
              <thead>
                <tr>
                  <th>Cliente<span class="caret"></span></th>
                  <th>Endereço<span class="caret"></span></th>
                  <th></th>
                  <th>Motorista<span class="caret"></span></th>
                  <th>Caçamba atual<span class="caret"></span></th>
                  <th>Nova Caçamba<span class="caret"></span></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Paulo Roberto Martins</td>
                  <td>Av. Sete de Setembro, 2346, Centro</td>
                  <td><a href="#" class="tTip obs" data-placement="right" data-toggle="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus, praesentium aperiam odio enim nostrum expedita aliquam molestias ab laboriosam commodi. Quis, adipisci amet hic cumque voluptates quas incidunt asperiores ut!">OBS &rsaquo;</a></td>
                  <td>Maurício <br /> <span class="text-warning aguardando">Aguardando ...</span></td>
                  <td>120</td>
                  <td>-------</td>
                </tr>
                <tr>
                  <td>Paulo Roberto Martins</td>
                  <td>Av. Sete de Setembro, 2346, Centro</td>
                  <td><a href="#" class="tTip obs" data-placement="right" data-toggle="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus, praesentium aperiam odio enim nostrum expedita aliquam molestias ab laboriosam commodi. Quis, adipisci amet hic cumque voluptates quas incidunt asperiores ut!">OBS &rsaquo;</a></td>
                  <td>
                    <div class="form-group col-md-8 no-margin no-padding">
                        <select id="motorista" class="form-control selectpicker">
                          <option>Selecione</option>
                          <option>José</option>
                          <option>Pedro</option>
                        </select>
                    </div>
                  </td>
                  <td>
                    <div class="col-md-7 form-group no-margin-bottom no-padding-left">
                      <input class="form-control" type="text" placeholder="Digite ...">
                    </div>
                  </td>
                  <td class="tdBtns">
                    <div class="col-md-4 form-group no-margin-bottom no-padding-left">
                      <input class="form-control" type="text" placeholder="Digite ..."></div>
                      <button type="button" class="btn btn-warning btn-sm btn-none">Trocar</i></button>
                      <button type="button" class="btn btn-default btn-sm btn-none"><i class="fa fa-reply"> </i><span class="btn-effect"> Cancelar</span></button>
                  </td>
                </tr>
                <tr class="warning">
                  <td colspan="8">
                    <i class="fa fa-exclamation-triangle"></i> Por favor, selecione o motorista para fazer a troca.
                    <a href="#" class="btn btn-link link-gray tClose"><i class="fa fa-times-circle"></i> Fechar</a>
                  </td>
                </tr>
                <tr class="warning">
                  <td colspan="8">
                    <i class="fa fa-exclamation-triangle"></i> Por favor, informe o número da cacámba atual (colocada no cliente).
                    <a href="#" class="btn btn-link link-gray tClose"><i class="fa fa-times-circle"></i> Fechar</a>
                  </td>
                </tr>
               <tr class="danger">
                  <td colspan="8">
                    <i class="fa fa-exclamation-triangle"></i> Você tem certeza que deseja cancelar a troca?
                    <button type="button" class="btn btn-danger btn-sm">Sim</button>
                    <button type="button" class="btn btn-default btn-sm">Não</button>
                    <a href="#" class="btn btn-link link-gray tClose"><i class="fa fa-times-circle"></i> Fechar</a>
                  </td>
                </tr>
                <tr class="success">
                  <td colspan="8">
                    <i class="fa fa-check-circle"></i> A troca foi cancelada com sucesso! A caçamba continua colocada.
                    <a href="#" class="btn btn-link link-gray tClose"><i class="fa fa-times-circle"></i> Fechar</a>
                  </td>
                </tr>
                <tr class="success">
                  <td colspan="8">
                    <i class="fa fa-check-circle"></i> A caçamba foi colocada com sucesso!
                    <a href="#" class="btn btn-link link-gray tClose"><i class="fa fa-times-circle"></i> Fechar</a>
                  </td>
                </tr>
              </tbody>
            </table>
            <p><a href="#" class="btn btn-link mais-clientes">Mostrar mais clientes <span class="caret caret-blue"></span></a></p>
          </div>
          <div class="tab-pane" id="mot-produtividade">
            <table id="tbl-caminhoes" class="table table-striped table-hover table-order">
              <thead>
                <tr>
                  <th>Cliente<span class="caret"></span></th>
                  <th>Endereço<span class="caret"></span></th>
                  <th></th>
                  <th>Motorista<span class="caret"></span></th>
                  <th>Nova Caçamba<span class="caret"></span></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Paulo Roberto Martins</td>
                  <td>Av. Sete de Setembro, 2346, Centro</td>
                  <td><a href="#" class="tTip obs" data-placement="right" data-toggle="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus, praesentium aperiam odio enim nostrum expedita aliquam molestias ab laboriosam commodi. Quis, adipisci amet hic cumque voluptates quas incidunt asperiores ut!">OBS &rsaquo;</a></td>
                  <td>Maurício <br /> <span class="text-danger aguardando">Aguardando ...</span></td>
                  <td>-------</td>
                </tr>
                <tr>
                  <td>Paulo Roberto Martins</td>
                  <td>Av. Sete de Setembro, 2346, Centro</td>
                  <td><a href="#" class="tTip obs" data-placement="right" data-toggle="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus, praesentium aperiam odio enim nostrum expedita aliquam molestias ab laboriosam commodi. Quis, adipisci amet hic cumque voluptates quas incidunt asperiores ut!">OBS &rsaquo;</a></td>
                  <td>
                    <div class="form-group col-md-8 no-margin no-padding">
                        <select id="motorista" class="form-control selectpicker">
                          <option>Selecione</option>
                          <option>José</option>
                          <option>Pedro</option>
                        </select>
                    </div>
                  </td>
                  <td class="tdBtns">
                    <div class="col-md-4 form-group no-margin-bottom no-padding-left">
                      <input class="form-control" type="text" placeholder="Digite ..."></div>
                      <button type="button" class="btn btn-danger btn-sm btn-none">Retirar</i></button>
                      <button type="button" class="btn btn-default btn-sm btn-none"><i class="fa fa-reply"> </i><span class="btn-effect"> Cancelar</span></button>
                  </td>
                </tr>
                <tr class="warning">
                  <td colspan="8">
                    <i class="fa fa-exclamation-triangle"></i> Por favor, selecione o motorista para fazer a troca.
                    <a href="#" class="btn btn-link link-gray tClose"><i class="fa fa-times-circle"></i> Fechar</a>
                  </td>
                </tr>
                <tr class="warning">
                  <td colspan="8">
                    <i class="fa fa-exclamation-triangle"></i> Por favor, informe o número da cacámba atual (colocada no cliente).
                    <a href="#" class="btn btn-link link-gray tClose"><i class="fa fa-times-circle"></i> Fechar</a>
                  </td>
                </tr>
                <tr class="warning">
                  <td colspan="8">
                    <i class="fa fa-exclamation-triangle"></i> Por favor, informe o número da nova caçamba (que será colocada no cliente)
                    <a href="#" class="btn btn-link link-gray tClose"><i class="fa fa-times-circle"></i> Fechar</a>
                  </td>
                </tr>
                <tr class="danger">
                  <td colspan="8">
                    <i class="fa fa-exclamation-triangle"></i> Você tem certeza que deseja cancelar a troca?
                    <button type="button" class="btn btn-danger btn-sm">Sim</button>
                    <button type="button" class="btn btn-default btn-sm">Não</button>
                    <a href="#" class="btn btn-link link-gray tClose"><i class="fa fa-times-circle"></i> Fechar</a>
                  </td>
                </tr>
                <tr class="success">
                  <td colspan="8">
                    <i class="fa fa-check-circle"></i> A troca foi cancelada com sucesso! A caçamba continua colocada.
                    <a href="#" class="btn btn-link link-gray tClose"><i class="fa fa-times-circle"></i> Fechar</a>
                  </td>
                </tr>
               <tr class="success">
                  <td colspan="8">
                    <i class="fa fa-check-circle"></i>  A caçamba foi colocada com sucesso!
                    <a href="#" class="btn btn-link link-gray tClose"><i class="fa fa-times-circle"></i> Fechar</a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
      </div>