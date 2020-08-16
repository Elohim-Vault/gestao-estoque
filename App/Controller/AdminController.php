<?php

class AdminController{
    public function index($erro = array()){
        $loader = new \Twig\Loader\FileSystemLoader('App/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('admin.html');
        $parametros = array();
        $parametros['produtos'] = Produto::selecionaProdutos($_SESSION['id_usuario']);
        $parametros['erro'] = $erro;
        $conteudo = $template->render($parametros);
        echo $conteudo;
    }

    public function criar(){
        $params = array(
            "nome"=>$_POST['nome'],
            "descricao"=>$_POST['descricao'],
            "quantidade"=>$_POST["quantidade"],
            "codigo"=>$_POST["codigo"],
            "preco"=>$_POST["preco"],
            "data_de_compra"=>$_POST['data_de_compra'],
            "id_usuario"=>$_SESSION['id_usuario']
        );

        Produto::criaProduto($params);
        header("Location: index.php?pagina=admin");
    }

    public function criarForm(){
        $loader = new \Twig\Loader\FileSystemLoader('App/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('criar.html');
        $conteudo = $template->render();
        echo $conteudo;
    }

    public function editar(){
        Produto::editaProduto($_POST);
        header("Location: index.php?pagina=admin");
    }

    public function editarForm(){
        $loader = new \Twig\Loader\FileSystemLoader('App/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('venda.html');
        $parametros = array();
        $parametros['produto'] = Produto::selecionaProdutoPeloId($_GET['id'])[0];
        $parametros['id'] = $_GET['id'];
        $conteudo = $template->render($parametros);
        echo $conteudo;
    }

    public function deletar(){
        try{
            Produto::deletaProduto($_GET['id']);
            header("Location: Index.php?pagina=admin");
        }catch(Exception $e){
            $this->index($e->getMessage());
        }
    }
}

?>