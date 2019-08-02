<?php
error_reporting(0);
session_name('painel');
session_start();

 if(isset($_SESSION['login'])) {
  $_SESSION['login'] = '';
  $login = '';
 } else {
  $login = '';  
  $_SESSION['login'] = '';
 }
 
 if(isset($_SESSION['senha'])) {
  $_SESSION['senha'] = '';
 } else {
  $senha = '';
  $_SESSION['senha'] = '';  
 }

session_destroy();
error_reporting(6143);
?>
<!doctype html>
<html>
 <head>
  <meta http-equiv="Content-Language" content="pt-br">
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <meta name="robots" content="nofollow, noindex">  
  <title>Painel Administrativo</title>
  <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/font-awesome.css">
  <script type="text/javascript" src="./js/jquery-1.11.3.js"></script>
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
  <script src="./bootstrap/js/bootstrap.min.js"></script>    
 </head>
 <body>
     <div class="disttopow">&nbsp;</div>
     <div class="container">
         <div class="row">
             <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">&nbsp;</div>
             <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                 <div class="alert alert-success TextoMsg1">
                  Sua sessão foi encerrada no Painel Administrativo, até logo!!!                  
                 </div>
             </div>
             <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">&nbsp;</div>
         </div>
     </div>   
 </body>
 <script type="text/javascript">
  $(".disttopow").css("margin-top","20%");
  $(".TextoMsg1").hide(6000);   
  setTimeout(function(){ document.location.href="index.php"; }, 5400); 
 </script>
</html>