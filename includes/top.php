<?php 
 session_name('painel');
 session_start();
 
 if(isset($_SESSION['login'])) {
  $login = $_SESSION['login'];
 } else {
  $login = '';
  echo '<!-- Login nao encontrado... -->'.PHP_EOL;
 }
 
 if(isset($_SESSION['senha'])) {
  $senha = $_SESSION['senha'];
 } else {
  $senha = '';
  echo '<!-- senha nao encontrado... -->'.PHP_EOL;
 } 

 include './includes/conexao.php'; 
 include './includes/funcoes.php'; 
?> 
<!doctype html>
<html>
 <head>
  <meta http-equiv="Content-Language" content="pt-br">
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <meta name="robots" content="nofollow, noindex">    
  <title>MadeSimple - Collectanea</title>
  <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/font-awesome.css">
  <script type="text/javascript" src="./js/jquery-1.11.3.js"></script>  
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
  <script src="./bootstrap/js/bootstrap.min.js"></script>    
  
  <script type="text/javascript" src="./source/jquery.fancybox.js?v=2.1.5"></script>
  <link rel="stylesheet" type="text/css" href="./source/jquery.fancybox.css?v=2.1.5" media="screen" />
  
  <link href="js/datatable/css/dataTables.bootstrap.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="./css/responsive.dataTables.min.css" />
  
  <script src="js/jquery-ui.min.js"></script>
  <link href="js/datatable/css/dataTables.jqueryui.css" rel="stylesheet" type="text/css"/>
  
  <script src="js/datatable/js/jquery.dataTables.js" type="text/javascript"></script>
  <script src="js/datatable/js/dataTables.jqueryui.js" type="text/javascript"></script>

  
  <script type="text/javascript" language="javascript" src="js/datatable/js/dataTables.responsive.min.js"></script>
  <script type="text/javascript" language="javascript" src="js/datatable/js/dataTables.jqueryui.min.js"></script>
  <script type="text/javascript" src="js/jquery.mixitup.min.js"></script>
  <script src="./js/ckeditor/ckeditor.js"></script>  
  <script src="./js/mascara.js"></script>
 </head> 
 <body>
<?php 
 include './objetos/restrito.php';
 if($UserLogged) {
  include './includes/menu.php'; 
 }
?>
  <div class="container-fluid">
<?php
 if($UserLogged == false) {
  echo $msg;
  include './includes/bottom.php';
  echo '<script type="text/javascript"> document.location.href="index.php"; </script>';
  die();
 } else {
 }
?>