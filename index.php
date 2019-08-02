<?php
 session_name('painel');
 session_cache_expire(240);
 session_start();
 $msg = '';
 $logado = false;
 ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Made Simple - Music Catalog Data</title>
<link rel="stylesheet" href="./css/bootstrap.css">
<script type="text/javascript" src="./js/jquery.min.js"></script>
<script type="text/javascript" src="./js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<style type="text/css">
 body { background-color: #eee; }
</style>
</head>
<body>
<?php
 error_reporting(1);
 if(isset($_POST['login'])) {

  $login = $_POST['login'];

  $resultado = false;
  if(isset($_POST['conta'])) {
   $conta = $_POST['conta'];
   if(is_numeric($conta)) {
    if($conta >= 0) {
     if($conta < 1999) {
      $x      = $_SESSION['palavra'];
      $Value1 = $_SESSION['Value1'];
      $Value2 = $_SESSION['Value2'];
      $y = 1 * ($Value1 + $Value2);
      if($conta == $y) {
       $resultado = true;
      }
     }
    }
   }
  }

  if($resultado) {
   include './includes/conexao.php';
   include './includes/funcoes.php';
  
   $usuario = TreatText($_POST['login']);

   if(isset($_POST['senha'])) {
    if(!empty($_POST['senha'])) {
     $senha = $_POST['senha'];
    } else {
     $senha = '';
    }
   } else {
    $senha = '';
   }

   if(!empty($usuario) && !empty($senha)) {
    include './objetos/login.class.php';
    $logn = new Login($pdo);
    $logn->logar($usuario,$senha);
    if($logn->erro == 'ok') {
     $logado = true;
     $_SESSION['login']  = $usuario;
     $_SESSION['senha']  = $senha;
     $_SESSION['logado'] = false;
     $msg = '<div class="alert alert-success text-center">Inicializing...</div>'."\n".'<script type="text/javascript">'."\n".' document.frm1.login.disabled = true;'."\n".' document.frm1.senha.disabled = true;'."\n".' document.frm1.conta.disabled = true;'."\n".' document.location.href="artist-list.php";'."\n".' </script>';
    } else {     
     $msg = '<div class="alert alert-warning">Sorry, we couldn\'t find an account with this username. Please check you\'re using the right username and try again.</div>';
    } 
   } else {
    $msg = '<div class="alert alert-success">Please give us your information to log in...</div>';
   }
  } else {
   $msg = '<div class="alert alert-success">Wrong result...</div>';
  }

 } else {
  $login = '';
  $senha = '';
 }
?>
<div class="jumbotron">
 <div class="row">
  <div class="col-md-4 col-sm-3 col-xs-1">&nbsp;</div>
  <div class="col-md-4 col-sm-6 col-xs-10">
   <form method="POST" name="frm1">
    <table class="table" style="background-color: #fff; border: solid 1px #fff; border-radius: 5px;">
     <tr><td colspan="2" align="center"><img src="./img/madesimple.png" width="img-responsive"></td></tr>
     <tr>
      <td><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Login</td>
      <td><input type="text" name="login" id="login" maxlength="128" value="<?php if(isset($login)) { echo $login; } ?>" class="form-control" required="required"></td>
     </tr>
     <tr>
      <td><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Password</td>
      <td><input type="password" name="senha" id="senha" maxlength="128" value="" class="form-control" required="required"></td>
     </tr>
     <tr>
      <td><img src="captcha.php" class="img-responsive"></td>
      <td><input type="text" name="conta" id="conta" value="" placeholder="Resultado???" maxlength="4" class="form-control" required="required"></td>
     </tr>
     <?php
      if(isset($msg)) {
          if(!empty($msg)) {
           echo '<tr><td colspan="2">'.$msg.'</td></tr>';
          }
      }
      if($logado == false) {
     ?>
     <tr><td colspan="2" align="right"><input type="submit" name="acessar" id="acessar" class="btn btn-success btn-xs" value="Log In!!!" onclick="this.disable; this.value='Aguarde, efetuando autenticação...';"></td></tr>
     <?php } ?>
    </table>
   </form>
   <script type="text/javascript">
    $("#senha").val("");
    $("#login").focus();
   </script>
  </div>
  <div class="col-md-4 col-sm-3 col-xs-1">&nbsp;</div>
 </div>
</div>
</body>
</html>