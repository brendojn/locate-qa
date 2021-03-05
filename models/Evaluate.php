<?php

class Evaluate extends model
{
    public function addEvaluateTask($user, $task, $time = 0, $automation = 0, $lighthouse = 0, $trello = 0, $jira = 0, $testrail = 0, $bugs = 0, $impact = 0)
    {

        $sql = "SELECT * from configuration ORDER BY id DESC LIMIT 1";
        $sql = $this->db->query($sql);

        $row = $sql->fetch();

        $config_time = $time * $row['config_time'];

        $config_process = ($automation + $lighthouse + $trello + $jira + $testrail ) * $row['config_proccess'];

        $config_bugs = $bugs * $row['config_bugs'];

        $config_impact = $impact * $row['config_impact'];

        $total = $config_bugs + $config_impact + $config_process + $config_time;

        if ($total > 100) {
            $total = 100;
        }


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

    public function addEvaluateDuty($user, $duty, $member, $font, $tag, $bugs)
    {
        $sql = "SELECT * from configuration ORDER BY id DESC LIMIT 1";

        $sql = $this->db->query($sql);

        $row = $sql->fetch();

        $config_member = $member * $row['config_member'];

        $config_font = $font * $row['config_font'];

        $config_tag = $tag * $row['config_tag'];

        $config_bugs = $bugs * $row['config_high_impact'];

        $total = $config_bugs + $config_tag + $config_font + $config_member;

        if ($total > 600) {
            $total = 600;
        }

        $sql = "SELECT * FROM dutys WHERE id = '$duty' AND evaluate = '0'";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() == 1) {
            $sql = "INSERT INTO evaluates SET fk_user_id = '$user', fk_duty_id = '$duty', impact = '$bugs', tag = '$tag', member = '$member', font = '$font'";
            $sql = $this->db->query($sql);

            $sql = "UPDATE dutys SET points = points - '$total', evaluate = '1' WHERE id = '$duty'";

            $sql = $this->db->query($sql);

            header("Location: " . BASE_URL . "dutys");
        } else {
            return "Plantão já se encontra avaliado";
        }
    }

    public function getEvaluate($task)
    {
        $array = array();

        $sql = "SELECT u.user
                FROM evaluates e
                JOIN tasks t ON (t.id = e.fk_task_id)
                JOIN users u ON (u.id = e.fk_user_id)
                WHERE t.id = '$task'";

        $sql = $this->db->query($sql);

        $array = $sql->fetch();

        return $array;
    }

}





