<?php

class Evaluate extends model
{
    public function addEvaluate($user, $task, $time = 0, $automation = 0, $lighthouse = 0, $trello = 0, $jira = 0, $testrail = 0, $bugs = 0, $impact = 0)
    {

        $config_time = $time * 5;

        $config_process = ($automation + $lighthouse + $trello + $jira + $testrail ) * 2;

        $config_bugs = $bugs * 5;

        $config_impact = $impact * 60;

        $total = $config_bugs + $config_impact + $config_process + $config_time;


        $sql = "SELECT * FROM tasks WHERE id = '$task' AND evaluate = '0'";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() == 1) {
            $sql = "INSERT INTO evaluates SET fk_user_id = '$user', fk_task_id = '$task', time = '$time', automation = '$automation', lighthouse = '$lighthouse', trello = '$trello', jira = '$jira', testrail = '$testrail', bugs = '$bugs', impact = '$impact'";
            $sql = $this->db->query($sql);

            $sql = "UPDATE tasks SET points = points - '$total', evaluate = '1' WHERE id = '$task'";
            $sql = $this->db->query($sql);

            header("Location: " . BASE_URL . "tasks");
        } else {
            return "Tarefa já se encontra avaliada";
        }
    }
}





