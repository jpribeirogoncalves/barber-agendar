<?php
session_start();

// Finaliza a sessão
session_unset();
session_destroy();

// Redireciona para a página de login ou outra página após o logout
header('Location: ../views/login.php');
exit();
?>
