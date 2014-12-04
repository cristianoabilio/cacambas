<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>Bem vindo ao Caçambas.com</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

		 <?php 
		 	$path_img  =  "http://cacambas.com";
		 	//$token = 1;
		 	$url_reset =  URL::to('password/reset', array($token));
		 ?>

        <style type="text/css">
			*, html {
				margin: 0; padding: 0; list-style: none;
			}
			body {
				background: #F7f7f7;
			}
			#content {
				width: 600px;
				height: auto;
			    margin: 30px auto;
			    color: #777;
			    font-size: 15px;
			    font-weight: normal;
			    font-family:"Helvetica Neue","Helvetica",Helvetica,Arial,sans-serif;  
			    line-height: 20px;
			    text-align: justify;
			}

			#content .logo {
				text-align: center;
				width: 250px;
				height: 35px;
				display: block;
				border: 0;
				margin: 0px auto;
				padding: 30px 0 30px 0 ;
			}

			#content .card {
				background: #FFFFFF;
				border-radius: 5px;
				border: 1px solid #E4E4E4;
			}

			#content .card .nome {
				font-size: 16px;
				font-weight: 500;
				color: #3977C4;
			}


			#content .card p {
				margin-bottom: 30px;
			}

			#content .card .bottom {
				background: #F1F1F1;
			    border-top: 1px solid #d9d9d9;
			    padding: 30px 25px 30px 25px;
			    border-radius: 0 0 5px 5px;
			    position: relative;
			}

			.padding {
				padding: 25px 25px 0 25px;
			}

			a.btn {
				text-decoration: none;

			}

			.btn {
			  	display: inline-block;
			  	margin-bottom: 0;
			  	font-weight: normal;
			  	text-align: center;
			  	vertical-align: middle;
			  	cursor: pointer;
			  	background-image: none;
			  	border: 1px solid transparent;
			  	white-space: nowrap;
			  	font-size: 14px;
			  	line-height: 1.42857;
			  	border-radius: 4px;
			  	-webkit-user-select: none;
			  	-moz-user-select: none;
			  	-ms-user-select: none;
  				user-select: none; 
  				width: 100%;
  				text-shadow: 1px 1px 0 #1E5896;
  			}
			.btn:focus, .btn:active:focus, .btn.active:focus {
			    outline: thin dotted;
			    outline: 5px auto -webkit-focus-ring-color;
			    outline-offset: -2px; 
			}
  			.btn:hover, .btn:focus {
			    color: #333333;
			    text-decoration: none; 
			}
  			.btn:active, .btn.active {
			    outline: 0;
			    background-image: none;
			    -webkit-box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
			    box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125); 
			}

			.btn-primary {
				color: white;
				background-color: #418BD9;
				border-color: #1E5896; 
			}
			.btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active {
				color: white;
			    background-color: #3D84D0;
			    border-color: #2c5ea8; 
			}

    		.btn-lg {
  				padding: 13px 0 13px 0;
  				font-size: 17px;
  				line-height: 1.35;
  				border-radius: 6px; 
  				font-weight: 400;
  			}

  			@media (min-width: 550px) and (max-width: 665px) {
				#content {
					width: 540px;
				}

				.btn-lg {
	  				font-size: 16px;
  				}
  			}

  			@media (max-width: 549px) {
				#content {
					width: 100%;
					font-size: 13px;
				}

				#content .card {
					border-radius: 0;
				}

				.btn-lg {
	  				font-size: 15px;
  				}
  			}

			a {
				color: #418BD9;
				text-decoration: none;
			}
			a:hover {
				color: #3D84D0;
				text-decoration: underline;
			}
  
		</style>
	</head>

	<body>
		<div id="content">
			<img class="logo" src="<?= $path_img; ?>/logo-email.png" alt="Caçambas.com">
			
			<div class="card">
				<h4 class="nome padding">Olá Fernando,</h4>

				<p class="padding">
				 Nós recebemos um pedido para alterar sua senha. Se você não fez este pedido
				 ignore este email. Caso contrário, você pode alterar sua senha no link abaixo: 
				</p>

				<div class="bottom">
					<a href="<?=$url_reset;?>" title="Clique para alterar sua senha" class="btn btn-lg btn-primary">Clique para alterar sua senha  &rsaquo;</a>
				</div>
			</div>
		</div>
	</body>
</html>