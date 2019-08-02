<?php
 include 'includes/top.php'; 
 
 include 'objetos/albums.class.php';
 $Objeto = new Albums($pdo);

 $erro            = 0;
 $msg             = '';
 $local           = '';
 $url_de_controle = 'albums.php';
 $url_externa     = ''; 
 $titulo_pg       = 'Albums';
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
  $msg = '<div class="alert alert-success">Record deleted! Wait for list...</div>';
 }

 if(($acao == 11 || $acao == 22) && $erro == 0) {

  if(isset($_POST['album'])) {
   $Objeto->album = $_POST['album'];
  }
  
  if(isset($_POST['id_artista'])) {
   $Objeto->id_artista = $_POST['id_artista'];
  }
  
  if(isset($_POST['ano'])) {
   $Objeto->ano = $_POST['ano'];
  }
  
  if($acao == 11 && $erro == 0) {
   $Objeto->insert();
   if($Objeto->erro == 'ok') {
    $msg .= '<div class="alert alert-success">Record['.$Objeto->album.'] saved! Wait remount list...</div>';    
   } else {
    $msg .= '<div class="alert alert-danger">'.$Objeto->erro.'</div>';
   }
  }

  if($acao == 22 && $erro == 0) {
   $Objeto->update($ide);
   if($Objeto->erro == 'ok') {
    $msg .= '<div class="alert alert-success">Record['.$Objeto->album.'] updated! Wait re-mount list...</div>';    
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
      $btn_legend = 'Update';
	 }
     if($acao == 1) {
      $acao = 11;
      $btn_legend = 'Save';
	 }
	 
     ?>            
     <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-2">
      <h3><?php echo $titulo_pg; ?></h3>    
      <form method="POST" action="<?php echo $url_de_controle; ?>" name="frm1" enctype="multipart/form-data">
       <input type="hidden" name="acao" id="acao" value="<?php echo $acao; ?>">
       <input type="hidden" name="ide" id="ide" value="<?php echo $ide; ?>">    
       <div class="form-group">
	    <label for="id_artista">Artist</label>
        <?php
		 $saida = '';
		 $sql = 'SELECT * FROM artists ORDER BY nome;';
		 $qry = $pdo->query($sql);
		 if($qry) {
		  $lin = $qry->rowCount();
		  if(is_numeric($lin)) {
		   if($lin > 0) {
            $saida = '<select class="form-control" name="id_artista" id="id_artista">'.PHP_EOL;		 
		    while($obj = $qry->fetch(PDO::FETCH_OBJ)) {
			 $saida .= '<option value="'.$obj->id.'"';
			 if($obj->id == $Objeto->id) {
			  $saida .= ' selected';
			 }
			 $saida .= '>'.$obj->nome.'</option>'.PHP_EOL;
			}
			$saida .= '</select>'.PHP_EOL;
		   } else {
		    $saida .= '<div class="alert alert-warning">Add Artist\'s <a href="artist-list.php?acao=1&ide=0" class="btn btn-success">HERE</a>!!!</div>';
		   }
		  } else {		  
		  }	 
		 } else {
		 }
		 echo $saida;
		 ?>		
       </div>
	   <div class="form-group">
	    <label for="nome">Album Name</label>
        <input type="text" name="album" value="<?php echo $Objeto->album; ?>" maxlength="255" class="form-control">
       </div>
       <div class="form-group">
	    <label for="ano">Year</label>
        <input type="text" name="ano" value="<?php echo $Objeto->ano; ?>" maxlength="4" onkeyup="mascara(this,mnum);" min="1900" max="2100"  class="form-control">
       </div>      
       <div class="form-group text-right">
        <a href="<?php echo $url_de_controle; ?>?acao=0&ide=0" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Voltar</a>
		&nbsp;
		<?php if($acao == 22) { ?>		
		<a href="<?php echo $url_de_controle; ?>?acao=0&ide=0" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
		&nbsp;
		<?php } ?>
        <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> <?php echo $btn_legend; ?></button>
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
  <a href="<?php echo $url_de_controle; ?>?acao=1&ide=0" class="btn btn-success" title="Add new Artist"><i class="fa fa-plus"></i> ADD New</a>
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
         <th>Artist</th>
		 <th>Twitter</th>
         <th>&nbsp;</th>		 
         <th>&nbsp;</th>
        </tr>
       </thead>
       <tbody>
        <?php       

        $jquery = '';
        $ins = 'SELECT a.`id`, a.`album`, a.`ano`, b.nome FROM `'.$tabela.'` a INNER JOIN artists b ON a.id_artista=b.id;';        
		$qry = $pdo->query($ins);
        if($qry) {
         $lin = $qry->rowCount();
         if(is_numeric($lin) && $lin > 0) {
          $saida = '';
          while($obj = $qry->fetch(PDO::FETCH_OBJ)) {           
           
           $saida .= '<tr>'.PHP_EOL;                      
		   $saida .= '<td>'.$obj->id.'</td>';
           $saida .= '<td>'.$obj->nome.'</td>';
		   $saida .= '<td>'.$obj->album.'</td>';
		   $saida .= '<td>'.$obj->ano.'</td>';
           $saida .= '<td><a href="'.$url_de_controle.'?acao=2&ide='.$obj->id.'" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-edit"></span></a></td>';
           $saida .= '<td><a href="'.$url_de_controle.'?acao=3&ide='.$obj->id.'" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></a></td>';
           $saida .= '</tr>';
          }

          echo $saida;
         } else {
          echo '<tr><td colspan="6">Empty Data...</td></tr>';
         }         
        } else {
         echo '<tr><td colspan="6"><br>SQL: '.$ins.'<p> - Error - Contact webmaster...</p></td></tr>';
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