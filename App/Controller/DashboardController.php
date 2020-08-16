<?php


class DashboardController{
    public function index(){
        Core::start_session();
        $loader = new \Twig\Loader\FileSystemLoader('App/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('dashboard.html');
        $parametros = array();
        $parametros['vendas'] = Vendas::selecionaVendas($_SESSION['id_usuario']);
        var_dump($parametros['vendas']);
        $conteudo = $template->render($parametros);
        echo $conteudo;
    }

    public function vendaForm(){
        $loader = new \Twig\Loader\FileSystemLoader('App/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('venda.html');
        $parametros = array();
        $produto = Produto::selecionaProdutoPeloId($_GET['id']);
        $parametros['produto'] = $produto[0];
        $conteudo = $template->render($parametros);
        echo $conteudo;
    }

    public function venda(){
        Core::start_session();
        $params = array(
            "id_produto"=>$_POST['id_produto'],
            "id_usuario"=>$_SESSION['id_usuario'],
            "preco"=>$_POST['preco'],
            "quantidade"=>$_POST['quantidade'],
            "data_de_venda"=>$_POST['data_de_venda']
        );

        Vendas::inserirVenda($params);
        var_dump($params);

    }
}
?>