<?php

class dutysController extends controller
{

    public function __construct()
    {
        $u = new User();
        $u->verifyLogin();
    }

    public function index()
    {
        $data = array();

        $d = new Duty();
        $p = new Payment();
        $e = new Employee();

        $filters = array(
            'employee' => '',
            'status' => ''
        );

        if (isset($_GET['filters'])) {
            $filters = $_GET['filters'];
        }

        $total_dutys = $d->getTotalDutys($filters);

        $p = 1;
        if (isset($_GET['p']) && !empty($_GET['p'])) {
            $p = addslashes($_GET['p']);
        }

        $per_page = 6;
        $total_pages = ceil($total_dutys / $per_page);

        $dutys = $d->getDutys($p, $per_page, $filters);

        $data['total_dutys'] = $total_dutys;
        $data['dutys'] = $dutys;
        $data['employees'] = $e->getEmployees();
        $data['filters'] = $filters;
        $data['total_pages'] = $total_pages;

        $this->loadTemplate('dutys', $data);
    }

    public function add()
    {
        $data = array();

        $d = new Duty();
        $e = new Employee();

        if (isset($_POST['week']) && !empty($_POST['week'])) {
            $week = addslashes($_POST['week']);
            $employee = addslashes($_POST['employee']);

            $data['erro'] = $d->createDuty($employee, $week);
        }

        $data['employees'] = $e->getEmployees();

        $this->loadTemplate('add-dutys', $data);
    }

    public function delete()
    {
        $d = new Duty();

        if (isset($_GET['week']) && !empty($_GET['week'])) {
            $d->deleteDuty($_GET['week']);
        }

        header("Location: " . BASE_URL . "dutys");
    }

    public function edit($week)
    {

        $data = array();

        $d = new Duty();
        $e = new Employee();

        if (isset($_POST['employee']) && !empty($_POST['employee'])) {
            $employee = addslashes($_POST['employee']);

            $d->editTasks($week, $employee);
            header("Location: " . BASE_URL . "dutys");
        }

        $data['getDuty'] = $d->getDuty($week);

        $data['employees'] = $e->getEmployees();

        $this->loadTemplate('edit-dutys', $data);
    }

    public function evaluate($duty)
    {
        $data = array(
            'user_id' => ''
        );

        $e = new Evaluate();
        $u = new User();

        $data['user_id'] = $u->getUserById($_SESSION['logged']);

        if (isset($_POST['member']) && !empty($_POST['member'])) {
            $user = addslashes($data['user_id']);
            $member = addslashes($_POST['member']);
            $font = addslashes($_POST['font']);
            $tag = addslashes($_POST['tag']);
            $bugs = addslashes($_POST['bugs']);

            $e->addEvaluateDuty($user, $duty, $member, $font, $tag, $bugs);

            header("Location: " . BASE_URL . "dutys");
        }

        $this->loadTemplate('evaluate-dutys', $data);

    }

    public function pay($task)
    {
        $data = array(
            'user_id' => ''
        );


        $t = new Task();
        $u = new User();
        $p = new Payment();

        $data['user_id'] = $u->getUserById($_SESSION['logged']);

        if (isset($_POST['value']) && !empty($_POST['value'])) {
            $user = addslashes($data['user_id']);
            $value = addslashes($_POST['value']);


            $percent = $t->getTaskById($task);
            $p->payTask($task, $user, $value, $percent['points']);

            header("Location: " . BASE_URL . "tasks");
        }

        $data['task'] = $t->getTaskById($task);

        $this->loadTemplate('pay-tasks', $data);

    }

    public function info($task)
    {

        $t = new Task();
        $e = new Evaluate();
        $p = new Payment();

        $data['payments'] = $p->getPayment($task);

        $data['evaluates'] = $e->getEvaluate($task);

        $data['final_value'] = $p->getPay($task);

        $data['task'] = $t->getTaskById($task);

        $this->loadTemplate('info-tasks', $data);
    }


}
