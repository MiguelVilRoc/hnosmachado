
<?php require_once Path::VIEW_CABECERA?>



<div class="container container-principal">
        <form action="<?=Redirect::COMPROBAR_USUARIO?>" method="post">
<div class="row">
    <div class="col-2">
        <label for="loginMail">Email: </label>
         <br> <br>
        <label for="loginPassword">Password: </label>
    </div>

    <div class="col-2">
        <input type="email" name="loginMail" id="loginMail"> <br> <br>
        <input type="password" name="loginPassword" id="loginPassword"> <br> <br>

    </div>

 </div>

        <input type="submit" value="Enviar">
    </form>
    <br>
    <p>¿No está usted registrado? <a href="<?=Redirect::DATOS_USUARIO?>">Regístrese</a></p>
</div>
    

<?php require_once Path::VIEW_PIE ?>