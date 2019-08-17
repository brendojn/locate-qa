<?php

class User extends model
{

    public function verificarLogin()
    {

        if (!isset($_SESSION['logged']) || (isset($_SESSION['logged']) && empty($_SESSION['logged']))) {
            header("Location: " . BASE_URL . "login");
            exit;
        }

    }

    public function logar($user, $password)
    {

        $sql = "SELECT * FROM users WHERE user = '$user' AND password = '$password'";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();

            $_SESSION['logged'] = $sql['id'];

            header("Location: " . BASE_URL);
            exit;
        } else {
            return "E-mail e/ou senha errados!";
        }

    }

    public function cadastrar($user, $password)
    {

        $sql = "SELECT * FROM users WHERE user = '$user'";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() == 0) {

            $sql = "INSERT INTO users SET user = '$user', password = MD5('$password')";
            $sql = $this->db->query($sql);

            $id = $this->db->lastInsertId();
            $_SESSION['logged'] = $id;

            header("Location: " . BASE_URL);

        } else {
            return "E-mail já está cadastrado!";
        }

    }

    public function getUser($id)
    {
        $sql = "SELECT user FROM users WHERE id = '$id'";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();

            return $sql['user'];
        } else {
            return '';
        }
    }

    public function getUsers()
    {
        $array = array();

        $sql = "SELECT * FROM users";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

}