@extends('templates.main')

@section('content')
<form role="form">
  <fieldset>
    <div class="row">
      <h2>Caçambas <small><span class="divider">/</span> Adicionar </small></h2>
      <hr>
    </div>
    <div class="row">
      <div class="form-group col-md-2 no-padding-left">
        <label for="nome">Pré-Número: </label>
        <input type="text" id="nome" class="form-control" >
      </div>
      <div class="form-group col-md-2">
        <label for="telefone">Número:  </label>
        <input type="text" id="telefone" class="form-control" >
      </div>
      <div class="form-group col-md-2">
        <label for="telefone">Pós-Número:  </label>
        <input type="text" id="telefone" class="form-control" >
      </div>
      <div class="form-group col-md-2">
        <label for="caminhao">Tipo da Caçamba: </label>
        <select id="caminhao" class="form-control selectpicker">
          <option>Selecione</option>
          <option>Opção 1</option>
          <option>Opção 2</option>
        </select>
      </div>
      <div class="form-group col-md-1">
        <label for="telefone">Volume:  </label>
        <input type="text" id="telefone" class="form-control input-volume" > m³
      </div>
      <div class="form-group col-md-1">
        <label for="telefone">Valor Base:  </label>
        <input type="text" id="telefone" class="form-control" >
      </div>
      <div class="form-group col-md-2">
        <label for="telefone">Número de Dias:  </label>
        <input type="text" id="telefone" class="form-control" >
      </div>
    </div>
    <hr>
    <div class="cadastro-completo">
      <div class="row">
        <div class="form-group col-md-2 no-padding-left">
          <label for="cpf">Quantidade: </label>
          <input type="text" id="cpf" class="form-control" >
        </div>
        <div class="form-group col-md-2">
          <label for="rg">Número inicial:  </label>
          <input type="text" id="rg" class="form-control" >
        </div>
        <blockquote class="opcional-cacambas">
          <p> <span>Opcional: </span>Você pode adicionar várias caçambas com as mesmas <br> informações cadastradas acima.  </p>
        </blockquote>
      </div>
    </div>
  </fieldset>
</form>
@stop