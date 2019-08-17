<?php

class homeController extends controller
{

    public function __construct()
    {
        $u = new User();
        $u->verificarLogin();
    }

    public function index()
    {
        $u = new User();
        $e = new Employee();

        $filters = array(
            'employee' => ''
        );
        if (isset($_GET['filters'])) {
            $filters = $_GET['filters'];
        }

        $employees = $e->getEmployees();

        $data['employees'] = $employees;
        $data['filters'] = $filters;

        $this->loadTemplate('home', $data);
    }

}