 <div id="wrapper">
    <div class="navbar navbar-default navbar-principal getFixed">
     <div class="col-md-4">
        <a href="#" class="gatilho"><button type="button" class="btn btn-principal btn-sm">
         <i class="fa fa-bars"></i> <span class="btn-effect">Opções</span>
        </button></a>
     </div>
     <div class="col-md-4">
        <h4 class="tit-no-btn">Central de <?php echo $section_title ?></h4>
     </div>
     <div class="col-md-4">
      <ul class="nav navbar-nav navbar-right">
        <li>
          <button type="button" class="btn btn-success btn-sm btn-modal">
           <span class="fa fa-plus"></span> <?php echo $section_title ?>
         </button>
        </li>
        <li class="active">
          <a href="#" class="tTip" data-placement="bottom" title="Lembretes"><i class="fa fa-bell fa-2x ativo"></i> <span class="badge">7</span></a>
        </li>
        <li>
          <a href="#" class="tTip" data-placement="bottom" data-toggle="tooltip" title="Ajuda"><i class="fa fa-info-circle fa-2x"></i></a>
        </li>
        <li class="no-border">
          <a href="<?php echo action('LoginController@logout');?>" class="tTip" data-placement="bottom" data-toggle="tooltip" title="Sair"><i class="fa fa-sign-out fa-2x"></i></a>
        </li>
      </ul>
     </div>
    </div> <!-- fim navbar-->