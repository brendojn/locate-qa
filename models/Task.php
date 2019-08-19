<?php

class Task extends model
{

    public function createTasks($employee, $complexity, $task, $points = 100)
    {

        $sql = "SELECT * FROM tasks WHERE task = '$task'";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() == 0) {
            $sql = "INSERT INTO tasks SET fk_employee_id = '$employee', fk_complexity_id = '$complexity', task = '$task', points = '$points'";

            $sql = $this->db->query($sql);


            header("Location: " . BASE_URL . "tasks");
        } else {
            return "Tarefa já se encontra cadastrada";
        }


    }


    public function getTaskById($id)
    {
        $array = array();

        $sql = "SELECT t.task, e.name, c.fibonacci, t.points, t.evaluate, t.pay FROM tasks t 
                JOIN employees e 
                ON (e.id = t.fk_employee_id)
                JOIN complexities c 
                ON (c.id = t.fk_complexity_id) 
                WHERE t.id = '$id'";

        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;

    }

    public function getTask($task)
    {
        $array = array();

        $sql = "SELECT t.task, e.name, c.fibonacci, t.points FROM tasks t 
                JOIN employees e 
                ON (e.id = t.fk_employee_id)
                JOIN complexities c 
                ON (c.id = t.fk_complexity_id) 
                WHERE task = '$task'";

        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;

    }

    public function getTasks($filters)
    {
        $array = array();

        $filtrostring = array('1=1');

        if(!empty($filters['employee'])) {
            $filtrostring[] = 't.fk_employee_id = :id_employee';
        }


        $sql = $this->db->prepare("SELECT t.id, t.task, e.name, c.fibonacci, t.points, t.evaluate, t.pay FROM tasks t 
                JOIN employees e 
                ON (e.id = t.fk_employee_id)
                JOIN complexities c 
                ON (c.id = t.fk_complexity_id)
                WHERE " . implode(' AND ', $filtrostring));

        if(!empty($filters['employee'])) {
            $sql->bindValue(':id_employee', $filters['employee']);
        }

        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getTasksByIdEmployee($employee)
    {
        $sql = "SELECT * FROM tasks WHERE fk_employee_id = '$employee' ";

        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function deleteTask($task)
    {
        $sql = "DELETE FROM tasks WHERE task = '$task'";

        $sql = $this->db->query($sql);
    }

    public function editTasks($task, $employee, $complexity)
    {
        $sql = "UPDATE tasks SET fk_employee_id = '$employee', fk_complexity_id = '$complexity' WHERE task = '$task'";
        $sql = $this->db->query($sql);

        header("Location: " . BASE_URL . "tasks");
    }

}





