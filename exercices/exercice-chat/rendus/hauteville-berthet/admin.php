<?php

    session_start();

    require_once 'config.php';

    include("head.php");

    ?>

    <div id="titre">
    <h1>Le chat de Solène et Héloïse</h1>
        <a class="logout" href="logout.php">Déconnexion</a>
    </div>
    
	<?php if (isset($_POST['newroom'])){
			$req = 'INSERT INTO rooms (room_name) VALUES (:room_name)';
	        $insert = $pdo->prepare($req);
	        $insert->execute(array('room_name' => $_POST['newroom']));

        }else if (isset($_GET['roomID']) && isset($_GET['user'])){

        	$result = $pdo->query("SELECT * FROM users WHERE id = '".$_GET['user']."'");
        	$user = $result->fetch();
        	if($user["role"] == "admin"){
        		$count = $pdo->exec("DELETE FROM rooms WHERE room_id = '".$_GET['roomID']."'");	
        	}

	    }
	    else if (isset($_GET['ban']) && isset($_GET['user']) && isset($_GET['userban'])){
	    	if($_GET['ban'] == 1){
	    		$result = $pdo->query("SELECT * FROM users WHERE id = '".$_GET['user']."'");
        		$user = $result->fetch();
        		if($user["role"] == "admin"){
        			$count = $pdo->exec("UPDATE users SET ban='1' WHERE id = '".$_GET['userban']."'");
        		}
	    	}
	    	else{
	    		$result = $pdo->query("SELECT * FROM users WHERE id = '".$_GET['user']."'");
        		$user = $result->fetch();
        		if($user["role"] == "admin"){
        			$count = $pdo->exec("UPDATE users SET ban='0' WHERE id = '".$_GET['userban']."'");
        		}
	    	}


	    } 
	?> 

    <div class="form_wrapper">
    <p class="container">
      <h3>Admin</h3>
    </p>

		<?php 



    $result = $pdo->query("SELECT * FROM rooms");?>
            <ul class="salons">
            <li class="titre">Les salons:</li>
            <?php while($room = $result->fetch()){ ?>
                <li><a class="room_name" href="<?php echo $room['room_id'] ?>"><?php echo $room['room_name'] ?></a> <a class="delete" href="admin.php?roomID=<?php echo $room['room_id']; ?>&user=<?php echo $_SESSION["id"] ?> ">Delete</a></li>
            <?php }?>
            </ul>

           <form action="" method="POST">
           	    <label class="titre_newroom" for="newroom">Nouvelle room:</label>	 <input type="text" name="newroom" id="newroom" placeholder="Nom de la nouvelle room">
           	    <input type="submit">
           </form>
			<?php $result = $pdo->query("SELECT * FROM users");?>
           <ul class="admin">
           		<li class="titre">Roles utilisateurs</li>
           		<?php while($user = $result->fetch()){ ?>
           			<li><?php echo $user["login"]; ?> : <?php echo $user["role"]; if($user['ban'] == 1){ echo '<span style="color:red"> bani </span> <a class="ban" href="admin.php?ban=0&user='.$_SESSION['id'].'&userban='.$user['id'].'"> Débanir</a>'; }else if($user['ban'] == 0 && $user["role"] != "admin"){ echo '<a class="ban" href="admin.php?ban=1&user='.$_SESSION['id'].'&userban='.$user['id'].'"> Banir</a>'; } ?>  </li> 
           		<?php }?>
           </ul>
    </div>
    <a class="return_button" href="index.php">Retour au chat</a>
