<?php
 $apelido = 'BlackDiamond Way'; 

try {   
      $pdo = new PDO( "mysql:host=localhost; port=3306; dbname=madesimple","root","");
      $pdo->exec('SET NAMES utf8');
      $pdo->exec("SET character_set_connection=utf8");
      $pdo->exec("SET character_set_client=utf8");
      $pdo->exec("SET character_set_results=utf8");     
     } catch ( PDOException $e ) {
      // Caso ocorra uma exceção, exibe na tela
      echo $e->getMessage();
     }
 
 // date_default_timezone_set('America/Sao_Paulo');
 // a partir do gov Bolsonaro foi derrubado horario de verao devido a este motivo adotar o gmt+3 para evitar problemas com horario errado
 date_default_timezone_set('ETC/GMT+3');
 
 $meses[1] = 'Jan';
 $meses[2] = 'Fev';
 $meses[3] = 'Mar';
 $meses[4] = 'Abr';
 $meses[5] = 'Mai';
 $meses[6] = 'Jun';
 $meses[7] = 'Jul';
 $meses[8] = 'Ago';
 $meses[9] = 'Set';
 $meses[10] = 'Out';
 $meses[11] = 'Nov';
 $meses[12] = 'Dez'; 
 
 function EqualizadorNominal($valor) {
  $retorno = '';
  $valor   = strtolower($valor);
  $bomba   = explode(' ',$valor);
  $colunas = count($bomba);
  for($i = 0; $i < $colunas; $i++) {
   $pedaco = $bomba[$i];
   if($pedaco == 'dos') {
   } else {
    if(@count($bomba[$i]) == 2) {
	 // echo '<p> nesse pedaco['.$i.']='.$bomba[$i].'</p>';	
	} else {
	 if($pedaco != 'de' && $pedaco != 'da') {	
	  $pedaco[0] = strtoupper($pedaco[0]);	
	  $bomba[$i] = $pedaco;
	 } else {
	  // $pedaco[0] = strtoupper($pedaco[0]);	
	  $bomba[$i] = $pedaco;
	 }
	}
   }
  }
  for($i = 0; $i < $colunas; $i++) {
   $retorno .= $bomba[$i];
   if($i < $colunas) {
    $retorno .= ' ';
   }
  }
  return $retorno;
 }
 
 function GerarEventos($pdo) {
  $sql = 'SELECT id, img, img2, exibir, titulo, texto, subtitulo FROM `textos` WHERE pagina="eventos.php" AND exibir="1" ORDER BY exibir DESC;';
  $qry1 = $pdo->query($sql);
  if($qry1) {
   $lin1 = $qry1->rowCount();
   if(is_numeric($lin1)) {
    if($lin1 > 0) {
	 while($obj1 = $qry1->fetch(PDO::FETCH_OBJ)) {	
	  
	  $PastaBase = '.././adlux-mmn/eventos/';
	  $Pasta = $PastaBase.toAscii($obj1->titulo).'-'.$obj1->id.'/';
	  if(!file_exists($Pasta)) {
       $CriarPasta = mkdir($Pasta);		  
	  }
	  $arquivo = $Pasta.'index.php';
	  if(file_exists($arquivo)) {
	   $ApagarArquivo = unlink($arquivo);
	  }
	  
	  $codigo  = '<?php'.PHP_EOL;
	  $codigo .= ' $host = "../.././";'.PHP_EOL;
	  $codigo .= ' $hostc = "../../.././";'.PHP_EOL;
	  $codigo .= ' $hostp = "http://www.adlux.com.br/novo/";'.PHP_EOL;
	  // $codigo .= ' $hostp = "http://localhost/adluxnovo/";'.PHP_EOL; // aki tiro essa linha quando no ambiente de producao
	  $codigo .= ' include $hostc."includes/conexao.php";'.PHP_EOL;
	  $codigo .= ' include $hostc."includes/funcoes.php";'.PHP_EOL;
	  $codigo .= ' include $hostc."admin/objetos/textos.class.php";'.PHP_EOL;
	  $codigo .= ' $textos = new Textos($pdo);'.PHP_EOL;
	  $codigo .= ' $textos->setbycol("tipou","facebook");'.PHP_EOL;
      $codigo .= ' $facebook  = $textos->url;'.PHP_EOL;  
      $codigo .= ' $textos->setbycol("tipou","youtube");'.PHP_EOL;
      $codigo .= ' $youtube   = $textos->url;'.PHP_EOL;
      $codigo .= ' $textos->setbycol("tipou","instagram");'.PHP_EOL;
      $codigo .= ' $instagram = $textos->url;'.PHP_EOL;
	  $codigo .= ' $textos->id        = '.$obj1->id.';'.PHP_EOL;
	  $codigo .= ' $textos->titulo    = "'.$obj1->titulo.'";'.PHP_EOL;
	  $codigo .= ' $textos->subtitulo = "'.$obj1->subtitulo.'";'.PHP_EOL;
	  $codigo .= ' $textos->texto     = "'.$obj1->texto.'";'.PHP_EOL;
	  $codigo .= ' $textos->img       = "'.base64_decode($obj1->img).'";'.PHP_EOL;
	  $codigo .= ' $textos->img2      = "'.base64_decode($obj1->img2).'";'.PHP_EOL;
      $codigo .= ' include $hostc."includes/galeria-mmn.php";'.PHP_EOL;
      $codigo .= ''.PHP_EOL;	  
	  $codigo .= '?>'.PHP_EOL;
	  
	  $myfile = @fopen($arquivo,"w");
      if($myfile) {
       fwrite($myfile,$codigo);
       fclose($myfile);
      }
	  
	 } //fim da listagem que gera as pastas e os index dentro delas
	}
   }
  }
 }
 
 function TreatUF($uf) {
  $uf = str_replace(chr(194),"",$uf);
  $uf = preg_replace('#(^\s+|\s+$)#', '', $uf);
  $uf = str_replace('\u00A0','',$uf);
  $uf = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $uf);
  $vetor = Array(".", "@", "_", "Â", "`", "^", "~", "Â", "/", "?", "!", "#", "=", "&", "$", "{", "}", "(", ")", "+", "[", "]", ";", ":", "*", ">", "<", " ", "%", "|", "\\", "f");
  for($i = 0; $i < count($vetor); $i++) {
   $uf = str_replace($vetor[$i],'',$uf);
  }   
  $uf = substr($uf,0,2);
  $uf = strtoupper($uf);
  return $uf;
 }
 
 function TreatCEP($cep) {
  $txt = $cep;	 
  $txt = rtrim(ltrim(trim($txt)));
  $txt = strtolower($txt);
  $txt = str_replace(' ','',$txt);
  $txt = str_replace(chr(194),"",$txt);
  $txt = preg_replace('#(^\s+|\s+$)#', '', $txt);
  $txt = str_replace('\u00A0','',$txt);
  $txt = str_replace("\u{c2a0}", "", $txt);
  $txt = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $txt);
  $vetor = Array(".", "@", "_", "Â", "`", "^", "~", "Â", "/", "?", "!", "#", "=", "&", "$", "{", "}", "(", ")", "+", "[", "]", ";", ":", "*", ">", "<", " ", "%", "|", "\\", "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z",'Á', 'À', "Ã", 'Ã','Ã', "Ã", "Ã");
  for($i = 0; $i < count($vetor); $i++) {
   $txt = str_replace($vetor[$i],'',$txt);
  }  
  $txt = substr($txt,0,9);
  $txt = stripslashes($txt);  
  return $txt;
 }
 
// funcao que retorna o ultimo dia do mes mto util 
function LastDay($month,$year) {
 $ld = date("t", mktime(0,0,0,$month,'01',$year));
 $ld = $year.'-'.$month.'-'.$ld;
 return $ld;
}

function TreatEmail($txt) {
  $txt = strtolower($txt);
  $txt = stripslashes($txt);  
  $txt = str_replace(chr(194),"",$txt);
  $txt = preg_replace('#(^\s+|\s+$)#', '', $txt);
  $txt = str_replace('\u00A0','',$txt);
  $txt = str_replace("\u{c2a0}", "", $txt);
  $txt = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $txt);
  $vetor = Array("Â", "`", "^", "~", "Â", "/", "?", "!", "#", "=", "&", "$", "{", "}", "(", ")", "+", "[", "]", ";", ":", "*", ">", "<", " ", "%", "|", "\\");
  for($i = 0; $i < count($vetor); $i++) {
   $txt = str_replace($vetor[$i],"",$txt);   
  }
  $vetor = Array('À','Á','Ã','Â','Ä','à','á','ã','â','é','Ç','ç','ê','è','ë','É','Ê','Í','í','Ì','Ô','Õ','ô','õ','ó','Ó','Ò','ò','ö','Ö','Ú','ú');
  $troca = Array("a","a","a","a","a","a","a","a","a","e","c","c","e","e","e","e","e","i","i","i","o","o","o","o","o","o","o","o","o","o","u","u");
  for($i = 0; $i < count($vetor); $i++) {
   $txt = str_replace($vetor[$i],$troca[$i],$txt);
  }
  return addslashes($txt);  
}

function TreatLogin($txt) {
 $txt = strtolower($txt);  
 $txt = trim($txt);
 $txt = rtrim($txt);
 $txt = ltrim($txt);
 $txt = str_replace(" ","",$txt);  
 $txt = str_replace(chr(194),' ',$txt);   
 $txt = preg_replace('#(^\s+|\s+$)#', '', $txt);
 $txt = str_replace('\u00A0','',$txt);
 $txt = str_replace("\u{c2a0}", "", $txt);
 $txt = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $txt);
 $txt = str_replace(" ","",$txt);  
 $vetor = Array("@", ".","^", "~", "/", "?", "!", "#", "=", "&", "$", "{", "}", "(", ")", "+", "[", "]", ";", ":", "*", ">", "<", " ", "%", "|", "\\");
 for($i = 0; $i < count($vetor); $i++) {
  $txt = str_replace($vetor[$i],"",$txt);   
 }
 $vetor = Array("Ã","ã","Á‚","á","À","à","Â","â","Ä","ä","Ç","ç","É","é","Ê","ê","è","È","Ë","ë","Ô","ô","ó","Ó","Ò","ò","Ö","ö","Õ","õ","Ú","ú");
 $troca = Array("a","a","a","a","a","a","a","a","a","a","c","c","e","e","e","e","e","e","e","e","o","o","o","o","o","o","o","o","o","o","u","u");
 for($i = 0; $i < count($vetor); $i++) {
  $txt = str_replace($vetor[$i],$troca[$i],$txt);
 }
 $txt = stripslashes($txt);
 return $txt;  
}
 
 function TreatText($txt,$limite = 0) {
    $txt = str_replace(chr(194),"",$txt);	 
    // $txt = str_replace('"','',$txt);
    // $txt = str_replace("\"",'',$txt);
    $txt = str_replace("'",'',$txt);
    // $txt = str_replace("`",'',$txt);
    $txt = str_replace("^",'',$txt);
    // $txt = str_replace("'",'',$txt);
    $txt = str_replace('  ','',$txt);
    $txt = str_replace('\\','',$txt);
    // $txt = str_replace('´','',$txt);
    // $txt = str_replace('`','',$txt);
	$txt = str_replace('NULL','',$txt);
	$txt = str_replace('Null','',$txt);
    $txt = str_replace('null','',$txt);
	$txt = str_replace('NULl','',$txt);
	$txt = str_replace('NUll','',$txt);
	$txt = str_replace('NuLL','',$txt);
	
    // $txt = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $txt);
    $txt = stripslashes(rtrim(trim(ltrim($txt))));
    if(isset($limite)) {
     if(is_numeric($limite)) {
      if($limite > 0) {
       $txt = substr($txt,0,$limite);
      }
     }
    }    
	$txt = str_replace('&nbsp;','',$txt);
	$txt = str_replace(chr(34),'',$txt);
	// $txt = EqualizadorNominal($txt);
    return addslashes($txt);
}

function TreatNumber($txt,$limite = 1) {
 if(!is_numeric($txt)) {
  return '0';
 } else {
  if($txt < 0) {
   return '0';
  } else {
   if($txt > $limite) {
    return '0';
   } else {
    return $txt;
   }
  }
 }
}

function ShowHUA($hua,$modo = "BR") {
    if ($modo == 'BR') {
        return $hua = substr($hua,8,2).'/'.substr($hua,5,2).'/'.substr($hua,0,4).' '.substr($hua,11,8);
    } else {
        return $hua = substr($hua,6,4).'-'.substr($hua,3,2).'-'.substr($hua,0,2).' '.substr($hua,11,8);
    }
}

function Select($icone = "fa-question-circle-o",$texto,$ide,$name,$coluna_id,$id,$tabela,$order,$exibir,$con,$css) {
    $sql = 'SELECT * FROM '.$tabela.' ORDER BY `'.$order.'`;';
    $qry = mysql_query($sql,$con);
    if ($qry) {
        $lin = mysql_num_rows($qry);
        if (is_numeric($lin)) {
            if ($lin > 0) {
                $s = '<div class="row entrelinhas">';
                $s .= '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
                $s .= '<div class="input-group">';
                $s .= '<span class="input-group-addon">';
                if (!empty($icone)) {
                    $s .= '<i class="fa '.$icone.'"></i> ';
                }
                if (!empty($texto)) {
                    $s .= $texto;
                }
                $s .= '</span>';
                $s .= '<select ';
                if (!empty($css)) {
                    $s .= 'class="'.$css.'"';
                }
                $s .= ' name="'.$name.'"';
                if (!empty($id)) {
                    $s .= ' id="'.$id.'"';
                }
                $s .= '>';
                while ($obj = mysql_fetch_object($qry)) {
                    $s .= '<option value="'.$obj->$coluna_id.'"';
                    if ($ide == $obj->$coluna_id) {
                        $s .= ' selected';
                    }
                    $s .= '>'.$obj->$exibir.'</option>';
                }
                unset($obj);
                $s .= '</select>';
                $s .= '</div>';
                $s .= '</div>';
                $s .= '</div>';
                echo $s;
            } else {
                echo '<input type="hidden" name="'.$name.'" value="0">';
                echo '<div class="alert alert-warning">Nenhum registro encontrado('.$tabela.')!</div>';
            }
        } else {
            echo '<div class="alert alert-danger">Ocorreu um erro na consulta<p>Erro: '.mysql_error().'</p><p>Instru&ccedil;&atilde;o SQL: '.$ins.'</p></div>';
        }
        unset($lin);
        @mysql_free_result($qry);
    } else {
        echo '<div class="alert alert-danger">Sistem indispon&iacute;vel no momento...<p>SQL: '.$ins.'</p><p>Erro: '.mysql_error().'</p>';
    }
}

function Comparativo($v1,$v2) {
  $valor2 = 1;
  $valor1 = 1;
  if($v1 == 'HOME') {
   $valor1 = 1;
  }
  if($v2 == 'HOME') {
   $valor2 = 1;
  }
  if($v1 == 'SAFIRA') {
   $valor1 = 2;
  }
  if($v2 == 'SAFIRA') {
   $valor2 = 2;
  }
  if($v1 == 'RUBI') {
   $valor1 = 3;
  }
  if($v2 == 'RUBI') {
   $valor2 = 3;
  }
  if($v1 == 'ESMERALDA') {
   $valor1 = 4;
  }
  if($v2 == 'ESMERALDA') {
   $valor2 = 4;
  }
  if($v1 == 'DIAMANTE') {
   $valor1 = 5;
  }
  if($v2 == 'DIAMANTE') {
   $valor2 = 5;
  }
  if($v1 == 'DUPLO DIAMANTE') {
   $valor1 = 6;
  }
  if($v2 == 'DUPLO DIAMANTE') {
   $valor2 = 6;
  }
  if($v1 == 'TRIPLO DIAMANTE') {
   $valor1 = 7;
  }
  if($v2 == 'TRIPLO DIAMANATE') {
   $valor2 = 7;
  }
  if($v1 == 'BLUE DIAMOND') {
   $valor1 = 8;
  }
  if($v2 == 'BLUE DIAMOND') {
   $valor2 = 8;
  }
  if($v1 == 'RED DIAMOND') {
   $valor1 = 9;
  }
  if($v2 == 'RED DIAMOND') {
   $valor2 = 9;
  }
  if($v1 == 'GREEN DIAMOND') {
   $valor1 = 10;
  }
  if($v2 == 'GREEN DIAMOND') {
   $valor2 = 10;
  }
  if($v1 == 'BLACK DIAMOND') {
   $valor1 = 11;
  }
  if($v2 == 'BLACK DIAMOND') {
   $valor2 = 11;
  }
  if($v1 == '---') {
   $valor1 = 0;
  }
  if($v2 == '---') {
   $valor2 = 0;
  }
  if($valor2 > $valor1) {
   return true;   
  } else {
   return false;
  }
 }
 
 function Graduacao($valor) {
     $saida = '';
     switch ($valor) {
         case '1' : $saida = 'HOME';
             break;
         case '2' : $saida = 'SAFIRA';
             break;
         case '3' : $saida = 'RUBI';
             break;
         case '4' : $saida = 'ESMERALDA';
             break;
         case '5' : $saida = 'DIAMANTE'; 
             break;
         case '6' : $saida = 'DUPLO DIAMANTE';
             break;
         case '7' : $saida = 'TRIPLO DIAMANTE';
             break;
         case '8' : $saida = 'BLUE DIAMOND';
             break;
         case '9' : $saida = 'RED DIAMOND';
             break;
         case '10' : $saida = 'GREEN DIAMOND';
             break;
		 case '11' : $saida = 'Black Diamond';
                     break;
         case 'Home' : $saida = 'Home';
                       break;
		 case 'Safira' : $saida = 'Safira';
             break;
         case 'Rubi' : $saida = 'RUBI';
             break;
         case 'Esmeralda' : $saida = 'ESMERALDA';
             break;
         case 'Diamante' : $saida = 'DIAMANTE'; 
             break;
         case 'Duplo Diamante' : $saida = 'DUPLO DIAMANTE';
             break;
         case 'Triplo Diamante' : $saida = 'Triplo Diamante';
             break;
         case 'Blue Diamond' : $saida = 'Blue Diamond';
             break;
         case 'Red Diamond' : $saida = 'Red Diamond';
             break;
         case 'Green Diamond' : $saida = 'Green Diamond';
             break;		   
         case 'Black Diamond' : $saida = 'Black Diamond';
                                break;		 
        default : $saida = 'Home';
            break;
     }   
     return $saida;
 }

 
 function tirarAcentos($string){
    return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
}

function ValidarData($dia) {
 if(empty($dia)) {
  return false;
 } else {
  $bomba = explode("/",$dia);
  $c     = count($bomba);
  if($c == 3) {
   $dia = $bomba[0];
   $mes = $bomba[1];
   $ano = $bomba[2];
   if($dia > 0) {
    if($dia > 31) {
     return false;    
    }  
   } else {
    return false;   
   }
   if($mes > 0) {
    if($mes > 12) {
     return false;    
    }   
   } else {
    return false;   
   }
   if(@checkdate($mes,$dia,$ano)) {
    return true;
   } else {
    return false;
   }	   
  } else {
   return false;
  }	  
 }
}

function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

?>
