<?php

class Employee extends model
{

    public function getEmployees()
    {
        $array = array();

        $sql = "SELECT * FROM employees";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

}