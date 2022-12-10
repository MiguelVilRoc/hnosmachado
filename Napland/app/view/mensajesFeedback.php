<?php if (isset($mensajeExito) && strlen($mensajeExito)>0) {?>
<div class="mensajeExito alert alert-success" role="alert"><?=$mensajeExito?></div>
<?php }
      if(isset($mensajeError) && strlen($mensajeError)>0) {
?>
<div class="mensajeError alert alert-danger" role="alert"><?=$mensajeError?></div>
<?php } 
      if(isset($mensajeErrorImagenDB) && strlen($mensajeErrorImagenDB)>0) {
?>
<div class="mensajeWarning alert alert-warning" role="alert"><?=$mensajeErrorImagenDB?></div>
<?php }?>