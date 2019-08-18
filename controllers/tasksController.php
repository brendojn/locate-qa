<?php

class tasksController extends controller
{

    public function __construct()
    {
        $u = new User();
        $u->verificarLogin();
    }

    public function index()
    {

        $data = array();

        $t = new Task();

        $tasks = $t->getTasks();

        $data['tasks'] = $tasks;

        $this->loadTemplate('tasks', $data);
    }

    public function add()
    {
        $data = array();

        $t = new Task();
        $e = new Employee();
        $c = new Complexity();


        if (isset($_POST['task']) && !empty($_POST['task'])) {
            $task = addslashes($_POST['task']);
            $employee = addslashes($_POST['employee']);
            $complexity = addslashes($_POST['complexity']);

            $dados['erro'] = $t->createTasks($employee, $complexity, $task);
        }

        $data['employees'] = $e->getEmployees();

        $data['complexities'] = $c->getComplexities();


        $this->loadTemplate('add-tasks', $data);
    }


    public function delete()
    {
        $t = new Task();

        if (isset($_GET['task']) && !empty($_GET['task'])) {
            $t->deleteTask($_GET['task']);
        }

        header("Location: " . BASE_URL . "tasks");
    }

    public function edit($task)
    {

        $data = array();

        $t = new Task();
        $e = new Employee();
        $c = new Complexity();

        if (isset($_POST['employee']) && !empty($_POST['employee'])) {

            $employee = addslashes($_POST['employee']);
            $complexity = addslashes($_POST['complexity']);

            $t->editTasks($task, $employee, $complexity);
            header("Location: " . BASE_URL . "tasks");

        }

        $data['getTask'] = $t->getTask($task);

        $data['employees'] = $e->getEmployees();

        $data['complexities'] = $c->getComplexities();

        $this->loadTemplate('edit-tasks', $data);

    }

}