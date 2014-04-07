<?php
	if(!empty($_GET['id'])){
		$query = $db->prepare("SELECT * FROM chat_room WHERE id = :id");
		$query->bindvalue(':id', (int) $_GET['id']);
		$query->execute();
		$correspondance = $query->fetch();

		if (!$correspondance){
			echo'<meta http-equiv="refresh" content="0; URL=index.php">';
			die();
		}
	}
	else{
		echo'<meta http-equiv="refresh" content="0; URL=index.php">';
		die();
	}
?>
<div class="container">
    <div class="tchat">

        <div class="message"></div>
        
        <div class="form">
            <form role="form" id="form">
                <div class="row">
                    <div class="col-xs-2 author_input">
                        <input type="text" class="form-control" name="author" placeholder="Votre Nom" id="author" value="<?php if(isset($_SESSION['author'])){echo $_SESSION['author'];}?>">
                    </div>
                    <div class="col-xs-9">
                        <div class="input-group">
                          <div class="input-group-btn">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" tabindex="-1">
                              <span class="glyphicon glyphicon-chevron-down"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <?php
                                    $smileys = $db->query("SELECT * FROM smiley");

                                    while($value = $smileys->fetch()){
                                        echo '<li><img src="./src/images/smileys/'.$value['smiley'].'" alt="'.$value['short'].'" class="smiley"></li>';
                                    }
                                ?>
                            </ul>
                          </div>
                          <input type="text" class="form-control" placeholder="Votre message ..." id="message">
                        </div>
                    </div>

                    <div class="col-lg-1">
                        <input type="submit" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div><br/>
    </div>
</div>