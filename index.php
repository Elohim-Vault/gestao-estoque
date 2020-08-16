<?php

require_once("App/Core/Core.php");
require_once("vendor/autoload.php");
require_once("lib/Database/Connection.php");

require_once('App/Model/Produto.php');
require_once('App/Model/Usuario.php');
require_once("App/Model/Vendas.php");

require_once("App/Controller/HomeController.php");
require_once("App/Controller/LoginController.php");
require_once("App/Controller/ErroController.php");
require_once("App/Controller/RegistroController.php");
require_once("App/Controller/AdminController.php");
require_once("App/Controller/DashboardController.php");

Core::start_session();
$template = file_get_contents("App/Template/estruturaDeslogado.html");
if($_SESSION['id_usuario']){
    $template = file_get_contents("App/Template/estruturaLogado.html");
}


ob_start();
    $core = new Core;
    $core->start($_GET);
    $saida = ob_get_contents();
ob_end_clean();

$templatePronto = str_replace("{{area_dinamica}}", $saida, $template);
echo $templatePronto
?>


