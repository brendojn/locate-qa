<?php

class environmentController extends controller
{

    public function __construct()
    {
        $u = new User();
        $u->verifyLogin();
    }

}