<?php
    
    $errors  = array();
    $success = array();

    if(!empty($_POST))
    {
        $data = sanetize($_POST);
        $errors = check($data);

        if(empty($errors))
        {
            $success[] = 'Well done';

            $exec = $pdo->exec('INSERT INTO users (login,email,password,age) VALUES (\''.$data['login'].'\',\''.$data['email'].'\',\''.$data['password'].'\',\''.$data['age'].'\')');
        }
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

    function check($data)
    {
        $errors = array();

        // Login
        if(empty($data['login']))
            $errors['login'] = 'Veuillez remplir le champ login';
        else if(strlen($data['login']) < 3)
            $errors['login'] = 'Votre login doit contenir 3 charactères minimum';
        else if(strlen($data['login']) > 20)
            $errors['login'] = 'Votre login doit contenir 20 charactères maximum';

        // Password
        if(empty($data['password']))
            $errors['password'] = 'Veuillez remplir le champ password';
        else if(strlen($data['password']) < 3)
            $errors['password'] = 'Votre password doit contenir 3 charactères minimum';
        else if(strlen($data['password']) > 20)
            $errors['password'] = 'Votre password doit contenir 20 charactères maximum';

        // Email
        if(empty($data['email']))
            $errors['email'] = 'Veuillez remplir le champ email';
        else if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL))
            $errors['email'] = 'Email invalide';

        // Age
        if($data['age'] < 18)
            $errors['age'] = 'Vous devez avoir plus de 18 ans';

        return $errors;
    }




