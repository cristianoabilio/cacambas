@extends('templates.login')

@section('content')
<body class="login">
  <div class="container">
    <div class="col-md-12 text-center">
      <h1 class="text-center"><img src="../../public/images/logo.png" alt="<?php echo Config::get('cacambas.name'); ?>" class="img-responsive logo"></h1>
    </div>
    <div class="col-md-4 col-md-offset-4 content-login">

      <div class="panel panel-danger panel-login box-login">
        <div class="panel-heading heading-error"></div>
        <div class="panel-body">
          <form action="<?php echo action('LoginController@doLogin'); ?>" method="post" name="formLogin" id="formLogin">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control" placeholder="Seu usuário" id="usuario" name="usuario">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" name="senha" class="form-control" placeholder="Sua senha" id="senha">
              </div>
            </div>
            <button type="submit" class="btn btn-primary btn-primary-login btn-lg btn-block logar">Ok, entrar  &rsaquo;</button>
          </form>
        </div>
        <div class="panel-footer text-right">
          <a href="#" class="esqueci-senha">Ops, esqueci minha senha  &rsaquo;</a>
        </div>
      </div>
      <div class="panel panel-login box-senha">
        <div class="panel-heading heading-error"></div>
        <div class="panel-body">
          <h3 class="panel-title text-primary">Esqueceu sua senha? </h3>
          <p>Escreva o email que você cadastrou no Caçambas e nós enviaremos uma nova senha para você!</p>
          <form action="#">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="text" class="form-control" placeholder="Seu email" id="email">
              </div>
            </div>
            <button type="button"  class="btn btn-primary btn-primary-login btn-lg btn-block logar">Recuperar senha  &rsaquo;</button>
          </form>
        </div>
        <div class="panel-footer text-right">
          <a href="#" class="voltar-login">Voltar ao Login  &rsaquo;</a>
        </div>
      </div>


      <div id="login-loading" class="panel panel-login hide">
        <div class="panel-body text-center">
          <img src="/images/ajax-loader.gif" height="62" width="62">
        </div>
        <div class="panel-footer text-center">
          <h4 class="loading">Entrando</h4>
        </div>
      </div>

    </div>


  </div>
  @stop