<?php
unset($_SESSION); 
session_destroy();
header("Location: ".Path::INICIO_APP);
?>
