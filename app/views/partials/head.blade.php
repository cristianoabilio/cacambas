<!DOCTYPE html>
<html ng-app="cacambas_app">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Caçambas.com">
        <meta name="keywords" content="">
        <meta name="author" content="Diego R. Antunes">
        <meta name="token" ng-init="token = '<?= csrf_token(); ?>'" ng-model="token" >
        <link rel="shortcut icon" href="favicon.ico">
        
        <title><?php echo Config::get('cacambas.name'); ?></title>

        <?php 
            $path_front =  "/front/dev"; 
            $path_css   =  /*(!Auth::check())  ?  $path_front."/css/login.css"  : */ $path_front."/css/style.css";
            $path_login = $path_front."/css/login.css";
        ?>

        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700' rel='stylesheet' type='text/css'>
        <link href="<?= $path_front; ?>/packages/normalize-css/normalize.css" rel="stylesheet">
        <link href="<?= $path_front; ?>/packages/animate-css/animate.min.css" rel="stylesheet">
        <link href="<?= $path_front; ?>/css/bootstrap.css" rel="stylesheet">
        <link href="<?= $path_front; ?>/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?= $path_front; ?>/packages/trNgGrid/release/src/css/trNgGrid.css">

        
        <link href="<?= $path_login; ?>" rel="stylesheet">
        <link href="<?= $path_css; ?>" rel="stylesheet">

        <!--[if lt IE 9]><script src="<?= $path_front; ?>/js/ie8-responsive-file-warning.js"></script><![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="<?= $path_front; ?>/js/html5shiv.js"></script>
          <script src="<?= $path_front; ?>/js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="{{view_active}}">
    