</div>
</body>  
<script src="js/custom.js"></script>
<script type="text/javascript" charset="utf-8">
 $(document).ready(function () {

  $(".fancy").fancybox();
  
  <?php if(isset($jquery) && !empty($jquery)) { 
         echo $jquery;
        }
  ?>

 });
</script>
<?php
if(isset($url_de_controle)) {
 LimpaGET($url_de_controle);
}
?>
</html>