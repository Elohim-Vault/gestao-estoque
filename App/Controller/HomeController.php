<?php

class HomeController{
    public function index(){
        $loader = new \Twig\Loader\FileSystemLoader('App/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('home.html');
        $parametros = array();
        $parametros['produtos'] = Produto::selecionaProdutos($_SESSION['id_usuario']);
        $conteudo = $template->render($parametros);
        echo $conteudo;
    }

}

?>