<?php

class Core{
    private static $paginasAbertas =  ['registro'];

    public function start_session(){
        if(session_id() == ''){
            session_start();
        }

        if(!isset($_SESSION['id_usuario'])){
            $_SESSION['id_usuario'] = '';
        }
        return true;
    }

    public function start($urlGet){
        if(isset($urlGet['metodo'])){
            $acao = $urlGet['metodo'];
        }else{
            $acao = 'index';
        }
        
        self::start_session();

        if(isset($urlGet['pagina']) and $_SESSION['id_usuario'] == true){
            $controller = $urlGet['pagina']. 'Controller';

        }elseif(!isset($urlGet['pagina']) and $_SESSION['id_usuario'] == true){
            $controller = 'HomeController';

        }elseif(isset($urlGet['pagina']) and in_array($urlGet['pagina'], self::$paginasAbertas)){
            $controller = $urlGet['pagina']. 'Controller';
            
        }else{
            $controller = 'LoginController';
        } 
        if(!class_exists($controller)){
            $controller = 'ErroController';
        }

        call_user_func_array(array(new $controller, $acao), array());
    }
}
?>