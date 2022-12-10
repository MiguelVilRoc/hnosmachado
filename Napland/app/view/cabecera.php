<!DOCTYPE html>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="title" content="Napland Website">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Miguel Villalba Roca">
    <meta name="description" content="Proyecto integrado para el ciclo de Tecnico Superior en Desarrollo de Aplicaciones Web del instituto IES Hermanos Machado">
    <meta name="keywords" content="descanso, proyecto, desarrollo">
    <title>
    <?php
        if(!$tituloPagina) {
            $tituloPagina = "Napland Website";
        }
        echo $tituloPagina;
    ?>
    </title>
    <!--<script type="text/javascript" src="--------Path::PUBLIC_JQUERY_JS------"></script>-->
    <?php $randomParam = "?id=".rand(0,1000)?>
    <link rel="stylesheet" href="<?=Path::PUBLIC_BOOTSTRAP_CSS?>">
    <link rel="stylesheet" href="<?=Path::PUBLIC_CSS_MAIN.$randomParam?>">
</head>


<?php require_once "navbar-cabecera.php"?>
