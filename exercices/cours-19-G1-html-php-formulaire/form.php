<?php 

    /**
     * TODO
     *  - Reminder
     *  - Validate
     *  - Highlight errors
     *  - Show errors messages
     *  - Add inputs
     *  - Save to database
     */

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
        $data['age']      = strip_tags(trim($data['age']));

        return $data;
    }