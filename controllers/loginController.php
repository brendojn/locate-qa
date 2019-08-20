<?php
class loginController extends controller {

    public function index() {
        $data = array();
        
        $this->loadView('login', $data);
    }

    public function entrar() {
    	$data = array('erro'=>'');

    	if(isset($_POST['user']) && !empty($_POST['user'])) {
    		$user = addslashes($_POST['user']);
    		$password = md5($_POST['password']);

    		$u = new User();
    		$data['erro'] = $u->login($user, $password);
    	}

    	$this->loadView('login_entrar', $data);
    }

    public function cadastrar() {
    	$data = array();

    	if(isset($_POST['user']) && !empty($_POST['user'])) {
    		$user = addslashes($_POST['user']);
    		$password = addslashes($_POST['password']);

    		$u = new User();
    		$data['erro'] = $u->addUser($user, $password);
    	}

    	$this->loadView('login_cadastrar', $data);
    }

    public function sair() {
    	unset($_SESSION['logged']);
    	header("Location: ". BASE_URL);
    }

}