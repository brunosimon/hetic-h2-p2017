<?php

    require 'cache.class.php';
    $cache = new Cache();

    function get_facebook_user($id)
    {
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,'http://graph.facebook.com/?id='.$id);
        curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        $result = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($result);

        return $result;
    }

    $error = false;
    $user  = false;

    if(!empty($_POST) && !empty($_POST['id']))
    {
        $id     = $_POST['id'];
        $result = $cache->get($id);

        // No cache
        if(!$result)
        {
            echo 'Not from cache';
            $result = get_facebook_user($id);
            $cache->set($id,$result);
        }

        // Cache
        else
        {
            echo 'From cache';
        }


        if(!empty($result->error))
        {
            $error = true;
        }

        else
        {
            $user = $result;
        }
    }

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Facebook search</title>
</head>
<body>
    <form action="#" method="POST">
        <input type="text" name="id">
        <input type="submit">
    </form>
    <?php if($error): ?>
        Une erreur s'est produite. Peut-être que l'utilisateur n'existe pô.
    <?php endif; ?>

    <?php if($user): ?>
        On l'a trouvé. Il s'agit de <strong><?php echo $user->name; ?></strong> avec le matricule <strong
        ><?php echo $user->id ?></strong>.
    <?php endif; ?>

</body>
</html>









