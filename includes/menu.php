<nav class="navbar navbar-default navbar-static-top">
 <div class="container">
  <div class="navbar-header">
   <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> 
    <span class="sr-only">Toggle navigation</span> 
    <span class="icon-bar"></span> 
    <span class="icon-bar"></span> 
    <span class="icon-bar"></span> 
   </button>
   <a class="navbar-brand nowrap" href="artist-list.php"> MadeSimple - Collectanea </a> 
  </div>
  <div id="navbar" class="navbar-collapse collapse">
   <ul class="nav navbar-nav">
    <li class="active"><a href="artist-list.php">Home</a></li>
    <li class="dropdown"> 
     <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Options <span class="caret"></span></a>
     <ul class="dropdown-menu">	  
      <li><a href="team-control.php">Team Control</a></li> 
	  <li><a href="artist-list.php">Artist List</a></li>
      <li><a href="albums.php">Albums</a></li>	        
     </ul>
    </li>   
   </ul>
   <ul class="nav navbar-nav navbar-right">
    <li><a href="logout.php"><i class="fa fa-open-door"></i> Logout <?php if(!empty($login)) { echo ' ('.$login.')'; } ?></a></li>
   </ul>
  </div>
 </div>
</nav>
<?php
 $acao = 0;
 $ide  = 0;
 
 $acao = filter_input(INPUT_POST, 'acao', FILTER_SANITIZE_SPECIAL_CHARS);
 $ide  = filter_input(INPUT_POST, 'ide', FILTER_SANITIZE_SPECIAL_CHARS);
 $id_externo = filter_input(INPUT_POST, 'id_externo', FILTER_SANITIZE_SPECIAL_CHARS);
 
 if($acao == false) {
  $acao = filter_input(INPUT_GET, 'acao', FILTER_SANITIZE_SPECIAL_CHARS);
 }
 
 if($ide == false) {
  $ide  = filter_input(INPUT_GET, 'ide', FILTER_SANITIZE_SPECIAL_CHARS);	 
 }
 
 if($id_externo == false) {
	 $id_externo = filter_input(INPUT_GET, 'id_externo', FILTER_SANITIZE_SPECIAL_CHARS);
	 if($id_externo == false) {
		 $id_externo = 0;
	 } else {
      if(!is_numeric($id_externo) || $id_externo < 0) {
		 $id_externo = 0;
	  } 
	 }
 } else {
	 if(!is_numeric($id_externo) || $id_externo < 0) {
		 $id_externo = 0;
	 }
 }
 
 if(!(is_numeric($acao) && $acao >= 0)) {
  $acao = 0;
 }

 if(!(is_numeric($ide) && $ide >= 0) || $acao == 1 || $acao == 11) {
  $ide = 0;
 }
 
 if($acao == 2 || $acao == 22 || $acao == 3) {
  if($ide <= 0) {
   $acao = 0;
   $ide  = 0;   
  }	 
 }      
 ?>