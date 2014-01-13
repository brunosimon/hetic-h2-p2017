<?php

    echo $_POST['login'];

    if(!empty($_POST))
    {
        echo '<pre>';
        print_r($_POST);
        echo '</pre>';

        $data = sanetize($_POST);

        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }

    else
    {
        $data = array(
            'login'    => '',
            'email'    => '',
            'password' => '',
            'age'      => 25
        );
    }

    function sanetize($data)
    {
        $data['login']    = strip_tags(trim($data['login']));
        $data['email']    = strip_tags(trim($data['email']));
        $data['password'] = strip_tags(trim($data['password']));
        $data['age']      = (int)$data['age'];

        return $data;
    }