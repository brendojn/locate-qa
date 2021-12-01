<?php

class Locate extends model
{

    public function createLocate($name_loc, $prevision_date, $user, $class)
    {
        $name_loc = trim($name_loc);
        $sql = "SELECT * FROM locate WHERE name = '$name_loc'";

        $prevision_date = explode(' ', $prevision_date);

        $sql = $this->db->query($sql);
        $class === 'environment' ? $environment = '0' : $device = '0';
        $class === 'device' ? $environment = '0' : $device = '1';
        if (!empty($prevision_date)) {
            $prevision_date[0] = implode("-", array_reverse(explode("/", $prevision_date[0])));

        } else {
            $prevision_date = null;
        }

        if ($sql->rowCount() == 0) {
            $sql = "INSERT INTO locate SET fk_user_id = '$user', name = '$name_loc', device = '$device', environment = '$environment', prevision_date = '$prevision_date[0] $prevision_date[1]'";
            $sql = $this->db->query($sql);

            header("Location: " . BASE_URL . "locates");
        } else {
            return "Locação já se encontra cadastrada";
        }
    }

    public function getTotalLocates($filters)
    {
        $array = array();

        $filtrostring = array('1=1');

        if (!empty($filters['name_object'])) {
            $filtrostring[] = 'name = :name_object';
        }

        $sql = $this->db->prepare("SELECT COUNT(*) as c FROM locate l WHERE ".implode(' AND ', $filtrostring));

        if (!empty($filters['name_object'])) {
            $sql->bindValue(':name_object', $filters['name_object']);
        }

        $sql->execute();
        $row = $sql->fetch();

        return $row['c'];
    }

    public function getLocates($filters)
    {
        $array = array();

        $filtrostring = array('1=1');

        if (!empty($filters['name_object'])) {
            $filtrostring[] = 'locate.id = :name_object';
        }

        $date_now = date("Y-m-d H:i:s");

        $sql = "SELECT l.id as locate_id, l.prevision_date, u.user, u.id as user_id FROM locate l
                JOIN users u 
                ON u.id = l.fk_user_id";
//        print_r($sql);die();
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        $u = new User();
        $isAdmin = $u->getUserByName('admin');

        foreach ($array as $ar) {
            if ($ar['prevision_date'] < $date_now && $ar['prevision_date'] !== null && $ar['user'] !== 'admin') {
                $this->editLocate($ar['locate_id'], $isAdmin, NULL);
            }
        }

        $sql = $this->db->prepare("SELECT locate.id, users.user, locate.name, locate.device, locate.environment, locate.prevision_date, l.fk_locate_id FROM locate 
                JOIN users
                ON users.id = locate.fk_user_id
                LEFT JOIN logs l 
                ON locate.id = l.fk_locate_id
                WHERE " . implode(' AND ', $filtrostring) .
                    " GROUP BY locate.id ORDER BY locate.name ASC");
        if (!empty($filters['name_object'])) {
            $sql->bindValue(':name_object', $filters['name_object']);
        }

        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function editLocate($id, $user, $prevision_date)
    {
        $array = array();

        $sql = "SELECT id, user FROM users WHERE id = '$user'";
        $sql = $this->db->query($sql);

        $prevision_date = explode(' ', $prevision_date);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        $user_id = $array['id'];
        $user_name = $array['user'];


        $sql = "SELECT id, name FROM locate WHERE id = '$id'";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        $locate_name = $array['name'];

        if (empty($user_id)) {
            $user_id = $isAdmin;
        }

        if ($prevision_date[0] !== '') {
            $prevision_date[0] = implode("-", array_reverse(explode("/", $prevision_date[0])));
        } else {
            $sql = "UPDATE locate SET fk_user_id = $user_id, prevision_date = NULL WHERE id = '$id'";
            $sql = $this->db->query($sql);

            $today = date("Y-m-d H:i:s");
            $sql = "INSERT INTO logs SET fk_locate_id = '$id', description = '[$locate_name] locado pelo usuário $user_name', created_at = '$today'";
            $sql = $this->db->query($sql);

            header("Location: " . BASE_URL . "locates");
        }

        $sql = "UPDATE locate SET fk_user_id = '$user_id', prevision_date = '$prevision_date[0] $prevision_date[1]' WHERE id = '$id'";
        $sql = $this->db->query($sql);


        $today = date("Y-m-d H:i:s");
        $sql = "INSERT INTO logs SET fk_locate_id = '$id', description = '[$locate_name] locado pelo usuário $user_name', created_at = '$today'";
        $sql = $this->db->query($sql);

        header("Location: " . BASE_URL . "locates");
    }

    public function getLocate($id)
    {
        $array = array();

        $sql = "SELECT * FROM locate WHERE id = '$id'";
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;
    }

    private function deleteLocate($id)
    {
        $sql = "DELETE FROM locate WHERE id = '$id'";

        $sql = $this->db->query($sql);
    }
}