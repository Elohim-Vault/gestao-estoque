<?php

class LoginController{
    public function index(){
        $loader = new \Twig\Loader\FileSystemLoader('App/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('login.html');
        $conteudo = $template->render();
        echo $conteudo;
    }


    public function login(){
        try{
            Core::start_session();
            $idUsuario = Usuario::Login($_POST['email'], $_POST['senha']);
            if($idUsuario){
                $_SESSION['id_usuario'] = $idUsuario;
                header("Location: index.php");
            }
        }catch(Exception $e){
            $this->index();
        }
     
    }

    public function logoff(){
        Core::start_session();
        $_SESSION['id_usuario'] = false;
        header("Location: index.php");
    }
}

?>