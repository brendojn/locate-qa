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

        $sql = "SELECT l.description, l.created_at, l.justification 
        FROM logs l 
        WHERE l.fk_locate_id = '$id'
        ORDER BY l.id DESC 
        LIMIT 500";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }
}