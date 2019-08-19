<?php

class Payment extends model
{

    public function payTask($task, $user, $value, $final_value = 0)
    {
        $sql = "SELECT * FROM tasks WHERE id = '$task' AND pay = '0'";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() == 1) {

            $final_value = ($final_value / 100) * $value;

            $sql = "INSERT INTO payments SET fk_user_id = '$user', fk_task_id = '$task', value = '$value', final_value = '$final_value'";
            $sql = $this->db->query($sql);

            $sql = "UPDATE tasks SET pay = '1' WHERE id = '$task'";
            $sql = $this->db->query($sql);

            header("Location: " . BASE_URL . "tasks");
        } else {
            return "Tarefa já se encontra avaliada";
        }
    }

    public function getPay($task)
    {

        $sql = "SELECT p.final_value FROM payments p
                JOIN tasks t
                ON (t.id = p.fk_task_id)
                WHERE t.id = '$task'";

        $sql = $this->db->query($sql);

        $sql = $sql->fetch();

        return $sql['final_value'];
    }

    public function getPayment($task)
    {

        $array = array();

        $sql = "SELECT * FROM payments p
                JOIN tasks t
                ON (t.id = p.fk_task_id)
                WHERE t.id = '$task'";

        $sql = $this->db->query($sql);

        $array = $sql->fetch();

        return $array;
    }
}





