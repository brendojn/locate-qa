<?php

class Employee extends model
{

    public function getEmployees()
    {
        $array = array();

        $sql = "SELECT e.id, e.name, count(t.task) as tasks FROM employees e
        LEFT JOIN tasks t
        ON t.fk_employee_id = e.id
        GROUP BY e.name";

        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function deleteEmployee($name)
    {
        $sql = "DELETE FROM employees WHERE employees.name = '$name'";
        $sql = $this->db->query($sql);
    }

    public function createEmployees($employee)
    {
        $sql = "SELECT * FROM employees WHERE employees.name = '$employee'";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() == 0) {
            $sql = "INSERT INTO employees SET employees.name = '$employee'";

            $sql = $this->db->query($sql);


            header("Location: " . BASE_URL . "employees");
        } else {
            return "QA já cadastrado";
        }


    }
}