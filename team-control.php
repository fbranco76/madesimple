<?php
 include 'includes/top.php'; 

 $Objeto = new Login($pdo);

 $erro            = 0;
 $msg             = '';
 $local           = '';
 $url_de_controle = 'team-control.php';
 $url_externa     = ''; 
 $titulo_pg       = 'Team Control';
 $limpa_get       = $url_de_controle;
 $tabela          = $Objeto->table;

 if($acao == 2 || $acao == 22 || $acao == 3) {
  $Objeto->set($ide);
  if($Objeto->erro != 'ok') {
   $erro = 1;
   $msg .= $Objeto->erro;
  }
 }
 
 if($acao == 3) {
  $Objeto->deletado = '1';	 
  $Objeto->update($ide);
  $msg = '<div class="alert alert-success">Record fired! Waiting back to list...</div>';
 }

 if(($acao == 11 || $acao == 22) && $erro == 0) {

  if(isset($_POST['nome'])) {
   $Objeto->nome = $_POST['nome'];
  }
  
  if(isset($_POST['email'])) {
   $Objeto->email = $_POST['email'];
  }
  
  if(isset($_POST['login'])) {
   $Objeto->login = $_POST['login'];
  }
  
  if(isset($_POST['senha'])) {
   $Objeto->senha = $_POST['senha'];   
  }
  
  if(isset($_POST['nivelquo'])) {
   $Objeto->nivel = $_POST['nivelquo'];
  } 
  
  if(isset($_POST['statusquo'])) {
   $Objeto->status = $_POST['statusquo'];
  }

  if($acao == 11 && $erro == 0) {
   $Objeto->insert();
   if($Objeto->erro == 'ok') {
    $msg .= '<div class="alert alert-success">Record saved! Returning to List...</div>';    
   } else {
    $msg .= '<div class="alert alert-danger">'.$Objeto->erro.'</div>';
   }
  }

  if($acao == 22 && $erro == 0) {
   $Objeto->update($ide);
   if($Objeto->erro == 'ok') {
    $msg .= '<div class="alert alert-success">Record updated! Back to list...</div>';    
   } else {
    $msg .= '<div class="alert alert-danger">'.$Objeto->erro.'</div>';
   }
  }
 }

 if($acao == 11 || $acao == 22 || $acao == 3) {
?>
<div class="container-fluid thumbnail">         
 <div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   <div class="card m-b-20">
    <div class="card-body" style="min-height: 410px;">
     <h3><?php echo $titulo_pg; ?></h3>    
     <p class="alert alert-success TextoMsg1" style="max-width: 300px;">
      <?php echo $msg; ?>                  
     </p>
    </div>
   </div>
  </div>
 </div>
</div>    
<?php 
 $jquery  = '$(".disttopow").css("margin-top","20%");'.PHP_EOL;
 $jquery .= '$(".TextoMsg1").hide(5000);'.PHP_EOL;   
 $jquery .= 'setTimeout(function(){ document.location.href="'.$url_de_controle.'?acao=0&ide=0"; }, 4000);'.PHP_EOL;
}

 if(($acao == 1 || $acao == 2) && $erro == 0) { ?>      
    <br>
    <br>
    <div class="row">
     <?php
     if($acao == 2) {
      $acao = 22;
     }
     if($acao == 1) {
      $acao = 11;
     }
     ?>            
     <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 col-lg-offset-2 col-md-offset-2 col-sm-offset-2">
      <center><h3><?php echo $titulo_pg; ?></h3></center>
      <form method="POST" action="<?php echo $url_de_controle; ?>" name="frm1" enctype="multipart/form-data">
       <input type="hidden" name="acao" id="acao" value="<?php echo $acao; ?>">
       <input type="hidden" name="ide" id="ide" value="<?php echo $ide; ?>">    
       <input type="hidden" name="nivel" value="1">
       <input type="hidden" name="status" value="1">
       <div class="row">     
        <div class="form-group col-lg-4 col-md-4 col-sm-5 col-xs-12 col-lg-offset-4 col-md-offset-4 col-sm-offset-3">
         <label for="nome">Name</label>
         <input type="text" name="nome" id="nome" value="<?php echo $Objeto->nome; ?>" maxlength="255" class="form-control">
        </div>
	   </div>	
	   <div class="row">	
        <div class="form-group col-lg-4 col-md-4 col-sm-5 col-xs-12 col-lg-offset-4 col-md-offset-4 col-sm-offset-3">
         <label for="login">Login</label>
         <td><input type="text" name="login" value="<?php echo $Objeto->login; ?>" maxlength="255" class="form-control"></td>
        </div>
       </div>        
       <div class="row">     
        <div class="form-group col-lg-4 col-md-4 col-sm-5 col-xs-12 col-lg-offset-4 col-md-offset-4 col-sm-offset-3">
         <label for="email">email</label>
         <input type="text" name="email" id="email" value="<?php echo $Objeto->email; ?>" maxlength="255" class="form-control">
        </div>			
       </div>
       <div class="row">	   
        <div class="form-group col-lg-4 col-md-4 col-sm-5 col-xs-12 col-lg-offset-4 col-md-offset-4 col-sm-offset-3">
         <label for="senha">Password</label>
         <input type="password" name="senha" id="senha" value="" maxlength="255" class="form-control">
        </div>
	   </div>
       <div class="row">
        <div class="col-lg-12 text-center">
         <a href="<?php echo $url_de_controle; ?>?acao=0&ide=0" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back</a>
		 &nbsp;
		 <?php if($acao == 22) { ?>
		  <a href="<?php echo $url_de_controle; ?>?acao=3&ide=<?php echo $ide; ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
		 <?php } ?>
		 &nbsp;
         <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Save </button>
        </div>
       </div>       
      </form>      
     </div>      
  </div>
 <?php } ?>

<?php if($acao == 0) { ?>
<div class="container">
<div class="jumbotron">    
<div class="row">
 <div class="col-lg-10 col-md-10 col-sm-10 col-xs-9">  
  <h3><?php echo $titulo_pg; ?></h3>
 </div>
 <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">  
  <a href="<?php echo $url_de_controle; ?>?acao=1&ide=0" class="btn btn-success"><i class="fa fa-plus"></i> Add New</a>
 </div>
 
</div>
   <form method="POST" action="<?php echo $url_de_controle; ?>" name="frm1" enctype="multipart/form-data">
    <input type="hidden" name="acao" id="acao" value="<?php echo $acao; ?>">
    <input type="hidden" name="ide" id="ide" value="<?php echo $ide; ?>">       
           
    <div class="row">
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <table class="datatable table responsive odd" cellspacing="0" width="100%">
       <thead>
        <tr>
         <th>ID</th>		
         <th>Name</th>
		 <th>Login</th>
         <th>email</th>
         <th>&nbsp;</th>		 
         <th>&nbsp;</th>
        </tr>
       </thead>
       <tbody>
        <?php       

        $jquery = '';
        $ins = 'SELECT * FROM `'.$tabela.'`;';        
		$qry = $pdo->query($ins);
        if($qry) {
         $lin = $qry->rowCount();
         if(is_numeric($lin) && $lin > 0) {
          $saida = '';
          while($obj = $qry->fetch(PDO::FETCH_OBJ)) {           
           
		   $saida .= '<tr>'.PHP_EOL;                      
           $saida .= '<td>'.$obj->id.'</td>';
		   $saida .= '<td>'.$obj->nome.'</td>';
           $saida .= '<td>'.$obj->login.'</td>';
           $saida .= '<td>'.$obj->email.'</td>';           
           $saida .= '<td><a href="'.$url_de_controle.'?acao=2&ide='.$obj->id.'" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-edit"></span></a></td>';
           $saida .= '<td><a href="'.$url_de_controle.'?acao=3&ide='.$obj->id.'" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></a></td>';
           $saida .= '</tr>';
          }

          echo $saida;
         } else {
          echo '<tr><td colspan="6">Waiting for records...</td></tr>';
         }         
        } else {
         echo '<tr><td colspan="6"><br>SQL: '.$ins.'<p> - Error - Contact developer...</p></td></tr>';
        }
        ?>         
       </tbody>
      </table>         
     </div>
    </div>

   </form>        
<?php 
 }
 include './includes/bottom.php'; 
?>