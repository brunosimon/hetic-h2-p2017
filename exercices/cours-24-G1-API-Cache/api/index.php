<?php 

    require_once 'cache.class.php';
    $cache = new Cache();

    // Get content from facebook graph
    function get_content($id)
    {
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,'http://graph.facebook.com/?id='.$id);
        curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        $result = curl_exec($ch);
        curl_close($ch);   

        return json_decode($result);
    }

    $user = false;

    // Data sent with ID
    if(!empty($_POST) && !empty($_POST['id']))
    {
        $id   = $_POST['id'];

        // Try to get user from cache
        $user = $cache->get($id);

        // User not in cache
        if(!$user)
        {
            echo 'Not from cache';

            // Get user from facebook API
            $user = get_content($id);

            // Add to cache
            $cache->set($id,$user);
        }

        // User in cache (faster)
        else
        {
            echo 'From cache';
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
    <?php if($user): ?>
        <div>
            L'utilisateur a été trouvé. Il s'agit de <?php echo $user->name ?> avec le matricule <?php echo $user->id ?>.
        </div>
    <?php endif; ?>
</body>
</html>














