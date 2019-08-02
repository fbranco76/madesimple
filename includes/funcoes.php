<?php
 function GetNomeMes($mes) {
  $meses = array('01'=>"Janeiro", '02'=>"Fevereiro", '03'=>"Mar&ccedil;o",
   '04'=>"Abril", '05'=>"Maio", '06'=>"Junho",
   '07'=>"Julho", '08'=>"Agosto", '09'=>"Setembro",
   '10'=>"Outubro", '11'=>"Novembro", '12'=>"Dezembro"
  );

  if($mes >= 01 && $mes <= 12)
   return $meses[$mes];

  return "M&ecirc;s deconhecido";
 }
 
 function MesPassado() {
  $mes = date("m");
  $ano = date("Y");
  if($mes == 1) {
   $mes = '12';
   $ano--;   
  } else {
   $mes--;   
  }
  return LastDay($mes,$ano);
 }
 
 function MediaHoras($t1="00:00:00",$t2="00:01:00") {
  $b1 = explode(":",$t1);
  $b2 = explode(":",$t2);
  $s1 = ($b1[1] * 60) + ($b1[0] * 60 * 60) + $b1[2];
  $s2 = ($b2[1] * 60) + ($b2[0] * 60 * 60) + $b2[2];
  $s3 = ceil(($s2 + $s1) / 2);
  $seg = $s3 % 60;
  $mins = floor($s3 / 60);
  $min = $mins % 60;
  $hora = floor($mins / 60);
  return $hora.":".str_pad($min, 2,0, STR_PAD_LEFT).":". str_pad($seg,2,0,STR_PAD_LEFT);  
 }
 
 function TreatCPF($cpf) {
  $cpf = str_replace("\u{c2a0}", "", $cpf);
  $cpf = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $cpf);
  $vetor = Array(".", "@", "_", "`", "^", "-","A","~", "/", "?", "!", "#", "=", "&", "$", "{", "}", "(", ")", "+", "[", "]", ";", ":", "*", ">", "<", " ", "%", "|", "\\", "f","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
  $cpf = strtolower($cpf);
  for($i = 0; $i < count($vetor); $i++) {
   $cpf = str_replace($vetor[$i],'',$cpf);
  }   
  $cpf = str_replace(' ','',$cpf);
  return $cpf;
 }
 
function LimpaGET($url) {
 echo '<script type="text/javascript" charset="utf-8">';
 echo 'window.history.pushState("object or string","Title","'.$url.'");';
 echo '</script>'; 
}

setlocale(LC_ALL, 'en_US.UTF8');
function toAscii($str, $replace=array(), $delimiter='-') {
 if(!empty($replace)) {
  $str = str_replace((array)$replace, ' ', $str);
 }
 
 $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
 $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
 $clean = strtolower(trim($clean, '-'));
 $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
 
 return $clean;
} 
 
 function UF2($uf, $field, $classe = "form-inline", $primeiro = "Todos") {
  echo("<select name=\"".$field."\" id=\"".$field."\" class=\"".$classe."\" \"> \n");
  
  echo '<option value="AC"';
  if($uf == "AC") {
   echo " selected";
  }
  echo(">Acre</option>");
  
  echo("<option value=\"AL\"");
  if($uf == 'AL') {
   echo " selected";
  }
  echo(">Alagoas \n");
  
  echo("<option value=\"AP\"");
  if($uf == 'AP') {
   echo " selected";
  }
  echo(">Amap&#225; \n");
  
  echo("<option value=\"AM\"");
  if($uf == 'AM') {
   echo " selected";
  }
  echo(">Amazonas \n");
  
  echo("<option value=\"BA\"");
  if($uf == 'BA') {
   echo " selected";
  }
  echo(">Bahia \n");
  
  echo("<option value=\"CE\"");
  if($uf == 'CE') {
   echo " selected";
  }
  echo(">Cear&#225; \n");
  
  echo("<option value=\"DF\"");
  if($uf == 'DF') {
   echo " selected";
  }
  echo(">Distrito Federal \n");
  
  echo("<option value=\"ES\"");
  if($uf == 'ES') {
   echo " selected";
  }
  echo(">Esp&#237;rito Santo \n");
  
  echo("<option value=\"GO\"");
  if($uf == 'GO') {
   echo " selected";
  }
  echo(">Goias \n");
  
  echo("<option value=\"MA\"");
    if ($uf == 'MA') {
        echo " selected";
    }
    echo(">Maranh&#227;o \n");
    echo("<option value=\"MT\"");
    if ($uf == 'MT') {
        echo " selected";
    }
    echo(">Mato Grosso \n");
    echo("<option value=\"MS\"");
    if ($uf == 'MS') {
        echo " selected";
    }
    echo(">Mato Grosso do Sul \n");
    echo("<option value=\"MG\"");
    if ($uf == 'MG') {
        echo " selected";
    }
    echo(">Minas Gerais \n");
    echo("<option value=\"PA\"");
    if ($uf == 'PA') {
        echo " selected";
    }
    echo(">Para \n");
    echo("<option value=\"PB\"");
    if ($uf == 'PB') {
        echo " selected";
    }
    echo(">Para&#237;ba \n");
    echo("<option value=\"PR\"");
    if ($uf == 'PR') {
        echo " selected";
    }
    echo(">Paran&#225; \n");
    echo("<option value=\"PE\"");
    if ($uf == 'PE') {
        echo " selected";
    }
    echo(">Pernambuco \n");
    echo("<option value=\"PI\"");
    if ($uf == 'PI') {
        echo " selected";
    }
    echo(">Piau&#237; \n");
    echo("<option value=\"RJ\"");
    if ($uf == 'RJ') {
        echo " selected";
    }
    echo(">Rio de Janeiro \n");
    echo("<option value=\"RN\"");
    if ($uf == 'RN') {
        echo " selected";
    }
    echo(">Rio Grande do Norte \n");
    echo("<option value=\"RS\"");
    if ($uf == 'RS') {
        echo " selected";
    }
    echo(">Rio Grande do Sul \n");
    echo("<option value=\"RO\"");
    if ($uf == 'RO') {
        echo " selected";
    }
    echo(">Rondonia \n");
    echo("<option value=\"RR\"");
    if ($uf == 'RR') {
        echo " selected";
    }
    echo(">Roraima \n");
    echo("<option value=\"SC\"");
    if ($uf == 'SC') {
        echo " selected";
    }
    echo(">Santa Catarina \n");
    echo("<option value=\"SP\"");
    if ($uf == 'SP') {
        echo " selected";
    }
    echo(">S&#227;o Paulo</option> \n");
    echo("<option value=\"SE\"");
    if ($uf == 'SE') {
        echo " selected";
    }
    echo(">Sergipe \n");
    echo("<option value=\"TO\"");
    if ($uf == 'TO') {
        echo " selected";
    }
    echo(">Tocantins \n");
    echo("</select> \n");
}

 function noSI($string) {
  $string = trim($string);
  $string = str_replace("'","",$string);//aqui retira aspas simples <'>
  $string = str_replace('"','',$string);//aqui retira aspas simples <'>
  $string = str_replace("\\","",$string);//aqui retira barra invertida<\\>
  $string = str_replace("UNION","",$string);//aqui retiro  o comando UNION <UNION>
       
  $banlist = array("insert", "select", "update", "delete", "distinct", "having", "truncate", "replace"," handler", "like", "procedure","group","'","union all", "'", " update", "-shutdown", "'", "¨", "'OR'1'='1'", " INSERT", " DROP", "XP_", " SELECT", " UPDATE", " DELETE", " DISTINCT", " HAVING", " TRUNCATE", "REPLACE"," HANDLER"," LIKE","PROCEDURE","GROUP","UNION","UPDATE","-SHUTDOWN","drop");
        // ---------------------------------------------
 if(eregi("[a-zA-Z0-9]+", $string)){
  $string = trim(str_replace($banlist,'',$string));
 }
 return $string;
}//END function noSqlInjection($string)

class Paginador {
 public $hideAll;
	public $saida;
 public $jquery;

 public function __construct() {
  $this->hideAll  = 'function HideAll() {'.PHP_EOL;
		$this->saida = '';
		$this->jquery = '';
	}
	
 public function CalcPages($linhas, $itensXpagina) {
  $total = $linhas / $itensXpagina;
  $bomba = explode('.', $total);
  $tem = count($bomba);
  if($tem > 1) {
   $total = $bomba[0] + 1;
  } else {
   $total = $total;
  }
  return $total;
 }
 
	public function Barra($lin,$itens) {
		$escreve = '<table class="table table-bordered">'.PHP_EOL;
		$escreve .= '<tr>'.PHP_EOL;
		$escreve .= '<td><a href="javascript:void(0);" id="pagina_anterior">Retroceder</a></td>'.PHP_EOL;
		$escreve .= '<td>'.PHP_EOL;
		$escreve .= '<select name="ir_para_pagina" id="ir_para_pagina">'.PHP_EOL;
		for($i=1;$i <= $this->CalcPages($lin,$itens);$i++) {
			$escreve .= '<option value="'.$i.'">'.$i.PHP_EOL;
		}
		$escreve .= '</select>'.PHP_EOL;
 	$escreve .= '</td>'.PHP_EOL;
		$escreve .= '<td><a href="javascript:void(0);" id="pagina_avancar">Avan&ccedil;ar</a></td>'.PHP_EOL;
		$escreve .= '</table>'.PHP_EOL;
		$escreve .= '<script type="text/javascript">'.PHP_EOL;
		$escreve .= 'function HideAll() {'.PHP_EOL;
		for($i=1;$i <= $this->CalcPages($lin,$itens);$i++) {
			$escreve .= ' $(".pagina'.$i.'").hide();'.PHP_EOL;
		}
		$escreve .= '}'.PHP_EOL;
		$escreve .= 'HideAll();'.PHP_EOL;
		$escreve .= '$(".pagina1").show();'.PHP_EOL;
		$escreve .= 'var pagina_atual = 1;'.PHP_EOL;
		$escreve .= 'var paginas = '.$this->CalcPages($lin,$itens).';'.PHP_EOL;
		$escreve .= '$("#pagina_anterior").click(function() {'.PHP_EOL;
		$escreve .= ' HideAll();'.PHP_EOL;
  $escreve .= 'if(pagina_atual === 1) {'.PHP_EOL;
		$escreve .= ' pagina_atual = paginas;'.PHP_EOL;
		$escreve .= ' $(".pagina"+paginas+"").show();'.PHP_EOL;
		$escreve .= ' $("#ir_para_pagina").val("" + pagina_atual + "");'.PHP_EOL;
		$escreve .= '} else {'.PHP_EOL;
		$escreve .= ' pagina_atual = pagina_atual - 1;'.PHP_EOL;
		$escreve .= ' $("#ir_para_pagina").val("" + pagina_atual + "");'.PHP_EOL;
		$escreve .= ' $(".pagina" + pagina_atual + "").show();'.PHP_EOL;
		$escreve .= '}'.PHP_EOL;
		$escreve .= '});'.PHP_EOL;
		$escreve .= '$("#pagina_avancar").click(function() {'.PHP_EOL;
  $escreve .= ' HideAll();'.PHP_EOL;
		$escreve .= ' pagina_atual = pagina_atual + 1;'.PHP_EOL;
		$escreve .= 'if(pagina_atual > paginas) {'.PHP_EOL;
		$escreve .= 'pagina_atual = 1;'.PHP_EOL;
		$escreve .= '$(".pagina1").show();'.PHP_EOL;
		$escreve .= ' $("#ir_para_pagina").val("" + pagina_atual + "");'.PHP_EOL;
		$escreve .= '} else {'.PHP_EOL;
		$escreve .= '$(".pagina" + pagina_atual + "").show();'.PHP_EOL;
		$escreve .= ' $("#ir_para_pagina").val("" + pagina_atual + "");'.PHP_EOL;
		$escreve .= '}'.PHP_EOL;
		$escreve .= '});'.PHP_EOL;																																					
		$escreve .= '$("#ir_para_pagina").change(function() {'.PHP_EOL;
  $escreve .= ' HideAll();'.PHP_EOL;																																																				
  $escreve .= '$(".pagina" + $("#ir_para_pagina").val() + "").show();'.PHP_EOL;																																																				
  $escreve .= '});'.PHP_EOL;																																																				
		$escreve .= '</script>'.PHP_EOL;
		echo $escreve;
	}
	
 public function Montar($lin, $itens) {
  $this->saida .= '<table class="table table-bordered" valign="top">'.PHP_EOL;
  $this->saida .= '<tr valign="top"><td valign="top">P&aacute;gina</td></tr>'.PHP_EOL;
  $this->saida .= '<tr valign="top">'.PHP_EOL;
  for($i=1; $i <= $this->CalcPages($lin,$itens); $i++) {
   $this->saida .= '<td><a href="javascript:void(0);" id="showPage'.$i.'" class="btn btn-success btn-xs">&nbsp;'.$i.'&nbsp;</a></td>';
   $this->jquery .= '$("#showPage'.$i.'").click(function() {'.PHP_EOL;
   $this->jquery .= ' HideAll();'.PHP_EOL;												   
   $this->jquery .= ' $(".pagina'.$i.'").show(480);'.PHP_EOL;												   
   $this->jquery .= '});'.PHP_EOL;												   
   $this->hideAll .= ' $(".pagina'.$i.'").hide();'.PHP_EOL;
  }
  $this->hideAll .= '}'.PHP_EOL;
  $this->saida .= '</td>'.PHP_EOL;
	 $this->saida .= '</tr>'.PHP_EOL;
  $this->saida .= '</table>'.PHP_EOL;
	}
	
	public function prn_jquery() {
		echo $this->hideAll.PHP_EOL.' HideAll();'.PHP_EOL.' $(".pagina1").show();'.PHP_EOL.$this->jquery.PHP_EOL;
	}
	
	public function __destruct() {
	}
}

function FormataTextoPagSeguro($texto) {
 $texto = preg_replace('/\d/', '', $texto);
 $texto = preg_replace('/[\n\t\r]/', ' ', $texto); 
 $texto = preg_replace('/\s(?=\s)/', '', $texto);
 $texto = trim($texto);
 return $texto;
}

function gerarSenha($tamanho=9, $forca=0) {
 $vogais = 'aeuy';
 $consoantes = 'bdghjmnpqrstvz';
 if($forca >= 1) {
  $consoantes .= 'BDGHJMPRSTWX';
 }
 if($forca >= 2) {
  $vogais .= "AEY";
 }
 if($forca >= 4) {
  $consoantes .= '2346789';
 }
 if($forca >= 8 ) {
  $vogais .= '2793';
 }
 
 $senha = '';
 $alt = time() % 2;
 for($i = 0; $i < $tamanho; $i++) {
  if($alt == 1) {
   $senha .= $consoantes[(rand() % strlen($consoantes))];
   $alt = 0;
  } else {
   $senha .= $vogais[(rand() % strlen($vogais))];
   $alt = 1;
  }
 }
 return $senha;
} 

function AddZeros($texto) {
 return sprintf('%04d', $texto);
}
?>