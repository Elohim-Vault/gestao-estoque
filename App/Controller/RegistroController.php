<?php

class RegistroController{
    public function index($erros = false){
        $loader = new \Twig\Loader\FileSystemLoader('App/View');
        $twig = new \Twig\Environment($loader);
        $parametros['erros'] = $erros;
        $template = $twig->load('registro.html');
        $conteudo = $template->render($parametros);
        echo $conteudo;
    }

    public function registro(){
        try{
            Usuario::registra($_POST['nome'], $_POST['email'], $_POST['senha']);
            header('Location: index.php');
        }catch(Exception $e){
            self::index($e->getMessage());
        }
    }
}
?>

