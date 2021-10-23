<?php

class Logs extends model
{

    public function getLogs()
    {
        $array = array();

        $sql = "SELECT * FROM logs";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getLogsByLocateId($id)
    {
        $array = array();

        $sql = "SELECT description, created_at FROM logs l WHERE l.fk_locate_id = '$id' LIMIT 5";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }
}