<?php

class Duty extends model
{

    public function createDuty($employee, $week, $points = 600)
    {
        $week = explode('-', $week);

        $d = new DateTime();
        $d->setISODate($week[0], preg_replace('/[^0-9]/', '', $week[1]));

        $date = $d->format('d/m/Y');

        $dateFinal = DateTime::createFromFormat('d/m/Y', $date);
        $dateFinal->add(new DateInterval('P4D'));
        $dateFinal = $dateFinal->format('d/m/Y');

        $sql = "SELECT * FROM dutys WHERE week = '$date - $dateFinal'";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() == 0) {
            $sql = "INSERT INTO dutys SET fk_employee_id = '$employee', week = '$date - $dateFinal', points = '$points'";
            $sql = $this->db->query($sql);


            header("Location: " . BASE_URL . "dutys");
        } else {
            return "Tarefa já se encontra cadastrada";
        }
    }

    public function getTotalDutys($filters)
    {
        $array = array();

        $filtrostring = array('1=1');

        if (!empty($filters['employee'])) {
            $filtrostring[] = 'd.fk_employee_id = :id_employee';
        }

        if(!empty($filters['status'])) {
            $filtrostring[] = 'd.evaluate = :evaluate AND d.pay = :pay';
        }

        if(!empty($filters['week'])) {
            $filtrostring[] = 'd.week = :week';
        }

        $sql = $this->db->prepare("SELECT COUNT(*) as c FROM dutys d WHERE ".implode(' AND ', $filtrostring));

        if (!empty($filters['employee'])) {
            $sql->bindValue(':id_employee', $filters['employee']);
        }

        if(!empty($filters['status'])) {
            $status = explode('-', $filters['status']);
            $sql->bindValue(':evaluate', $status[0]);
            $sql->bindValue(':pay', $status[1]);
        }

        if (!empty($filters['week'])) {
            $sql->bindValue(':week', $filters['week']);
        }

        $sql->execute();
        $row = $sql->fetch();

        return $row['c'];
    }

    public function getDutys($page, $per_page, $filters)
    {
        $offset = ($page - 1) * $per_page;

        $array = array();

        $filtrostring = array('1=1');

        if (!empty($filters['employee'])) {
            $filtrostring[] = 'd.fk_employee_id = :id_employee';
        }

        if(!empty($filters['status'])) {
            $filtrostring[] = 'd.evaluate = :evaluate AND d.pay = :pay';
        }

        if(!empty($filters['week'])) {
            $filtrostring[] = 'd.week = :week';
        }

        $sql = $this->db->prepare("SELECT d.id, d.week, e.name, d.points, d.evaluate, d.pay FROM dutys d
                JOIN employees e 
                ON (e.id = d.fk_employee_id)
                WHERE " . implode(' AND ', $filtrostring)." ORDER BY id DESC LIMIT $offset, $per_page");
        if (!empty($filters['employee'])) {
            $sql->bindValue(':id_employee', $filters['employee']);
        }

        if(!empty($filters['status'])) {
            $status = explode('-', $filters['status']);
            $sql->bindValue(':evaluate', $status[0]);
            $sql->bindValue(':pay', $status[1]);
        }

        if (!empty($filters['week'])) {
            $sql->bindValue(':week', $filters['week']);
        }

        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function deleteDuty($week)
    {
        $sql = "DELETE FROM dutys WHERE week = '$week'";

        $sql = $this->db->query($sql);
    }

    public function editTasks($id, $employee)
    {
        $array = array();

        $sql = "SELECT id FROM employees WHERE id = '$employee'";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        $employee_id = $array['id'];

        $sql = "UPDATE dutys SET fk_employee_id = '$employee_id' WHERE id = '$id'";
        $sql = $this->db->query($sql);

        header("Location: " . BASE_URL . "dutys");
    }

    public function getDuty($id)
    {
        $array = array();

        $sql = "SELECT d.week, e.id, e.name, d.points FROM dutys d 
                JOIN employees e 
                ON (e.id = d.fk_employee_id)
                WHERE d.id = '$id'";
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;
    }

    public function getDutyById($id)
    {
        $array = array();

        $sql = "SELECT d.week, e.name, d.points, d.evaluate, d.pay FROM dutys d 
                JOIN employees e 
                ON (e.id = d.fk_employee_id)
                WHERE d.id = '$id'";

        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;

    }


}