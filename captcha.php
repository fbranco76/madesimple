<?php
session_name('painel');
session_start(); // inicial a sessao
header("Content-type: image/jpeg"); // define o tipo do arquivo
    
    function captcha($largura,$altura,$tamanho_fonte,$v1) {
        $imagem = imagecreate($largura,$altura); // define a largura e a altura da imagem
        $fonte = "./fonts/calibri.ttf"; //voce deve ter essa ou outra fonte de sua preferencia em sua pasta
        $preto  = imagecolorallocate($imagem,0,0,0); // define a cor preta
        $branco = imagecolorallocate($imagem,255,255,255); // define a cor branca
        
        // define a palavra conforme a quantidade de letras definidas no parametro $quantidade_letras
        $_SESSION["palavra"] = $v1; // atribui para a sessao a palavra gerada
        
            imagettftext($imagem,$tamanho_fonte,12, 29 ,27, $branco,$fonte,$v1); // atribui as letras a imagem
        
        imagejpeg($imagem); // gera a imagem
        imagedestroy($imagem); // limpa a imagem da memoria
    }
    
    $var1 = rand(0,9);
    $var2 = rand(0,9);
    $valor1 = $var1.'+'.$var2;
    $_SESSION['Value1'] = $var1;
    $_SESSION['Value2'] = $var2;
    captcha(120,32,16,$valor1);
    ?>