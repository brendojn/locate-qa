<?php

class locatesController extends controller
{

    public function __construct()
    {
        $u = new User();
        $u->verifyLogin();
    }

    public function index()
    {
        $data = array();

        $l = new Locate();
        $u = new User();

        $filters = array(
            'name_object' => '',
        );

        if (isset($_GET['filters'])) {
            $filters = $_GET['filters'];
        }

        $total_locates = $l->getTotalLocates($filters);

        $locates = $l->getLocates($filters);

        $data['total_locates'] = $total_locates;
        $data['locates'] = $locates;
        $data['users'] = $u->getUsers();
        $data['filters'] = $filters;
        $data['userLogged'] = $u->getUser($_SESSION['logged']);

        $this->loadTemplate('locates', $data);
    }

    public function add()
    {
        $l = new Locate();
        $u = new User();

        if (isset($_POST['name_loc']) && !empty($_POST['name_loc'])) {
            $name_loc = addslashes($_POST['name_loc']);
            $prevision_date = addslashes($_POST['prevision_date']);
            $user = $u->getUserById($_SESSION['logged']);
            $class = addslashes($_POST['class']);

            $data['erro'] = $l->createLocate($name_loc, $prevision_date, $user, $class);
        }

        $this->loadTemplate('add-locates');
    }


    public function edit($id)
    {
        $data = array();

        $l = new Locate();
        $u = new User();

        if (isset($_POST['user']) && !empty($_POST['user'])) {
            $user = addslashes($_POST['user']);
            $prevision_date = addslashes($_POST['prevision_date']);

            $l->editLocate($id, $user, $prevision_date);
            header("Location: " . BASE_URL . "locates");
        }

        $data['users'] = $u->getUsers();

        $data['getLocate'] = $l->getLocate($id);

        $this->loadTemplate('edit-locates', $data);
    }

}