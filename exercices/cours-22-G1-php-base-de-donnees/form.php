<?php 

    $errors  = array();
    $success = array();
    if(!empty($_POST))
    {
        // Supprimer
        if($_POST['action'] == 'delete')
        {
            $data = get_default();

            if(!empty($_POST['id']))
            {
                $id = (int)$_POST['id'];
                $exec = $pdo->exec('DELETE FROM users WHERE id = '.$id);

                if($exec)
                    $success[] = 'User deleted';
                else
                    $errors[] = 'User not deleted';
            }
        }

        // Ajouter
        else if($_POST['action'] == 'add')
        {
            $data   = sanetize($_POST);
            $errors = check($data);

            if(empty($errors))
            {
                $exec = $pdo->exec('INSERT INTO users (login,password,email,age) VALUES (\''.$data['login'].'\',\''.$data['password'].'\',\''.$data['email'].'\','.$data['age'].')');
                
                $data = get_default();

                $success[] = 'User well registered';
            }
        }
    }
    else
    {
        $data = get_default();
    }

    function get_default()
    {
        return array(
            'login'    => '',
            'password' => '',
            'email'    => '',
            'age'      => 25
        );
    }

    function sanetize($data)
    {
        $data['login']    = strip_tags(trim($data['login']));
        $data['password'] = strip_tags(trim($data['password']));
        $data['email']    = strip_tags(trim($data['email']));
        $data['age']      = (int)$data['age'];

        return $data;
    }

    function check($data)
    {
        $errors = array();

        // Login
        if(empty($data['login']))
            $errors['login'] = 'You should fill you login';
        else if(strlen($data['login']) < 3)
            $errors['login'] = 'Login should be 3 chars length minimum';
        else if(strlen($data['login']) > 30)
            $errors['login'] = 'Login should be 30 chars length maximum';

        // Password
        if(empty($data['password']))
            $errors['password'] = 'You should fill you password';
        else if(strlen($data['password']) < 3)
            $errors['password'] = 'Password should be 3 chars length minimum';
        else if(strlen($data['password']) > 30)
            $errors['password'] = 'Password should be 30 chars length maximum';

        // Email
        if(empty($data['email']))
            $errors['email'] = 'You should fill you email';
        else if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL))
            $errors['email'] = 'Wrong email';

        // Age
        if($data['age'] < 18)
            $errors['age'] = 'Too young';

        return $errors;
    }


















