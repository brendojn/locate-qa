<?php

class Complexity extends model
{

    public function getComplexities()
    {
        $array = array();

        $sql = "SELECT * FROM complexities";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }


}