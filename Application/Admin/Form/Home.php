<?php
namespace Admin\Form;

use Du\Form;

class Home extends Form
{
    public function index()
    {
        return array(
            "name"=>md5($_GET['name']),
        );
    }
}