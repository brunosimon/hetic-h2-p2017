<?php 
	
	session_start();

	error_reporting(E_ALL); 
	ini_set('display_errors', 1);

	require('../include/config.php');
	include ('../include/header-debate.php');

	$id 		= $_GET['id'];

	if (isset($_SESSION['id'])) {

		$idSender	= $_SESSION['id'];
		
		$prepare = $pdo->prepare('SELECT * FROM debates');
		$prepare -> execute();
		$debates = $prepare->fetchAll();

		foreach ($debates as $key => $value) {
			if($value['id']==$id) {
				$is404 = false;	
			} else {
				$is404 = true;
			}
		}

		if ($is404) {
			header("Location: /");
			echo "is 404";
		}

	} else {
		header('Location: /');
	}

	$prepare = $pdo->prepare('SELECT * FROM users WHERE id=:id');
	$prepare->bindValue(':id', $idSender, PDO::PARAM_INT);
	$prepare->execute();
	$logins = $prepare->fetch();

	$login 			= $logins['name'];

	$prepare = $pdo->prepare('SELECT * FROM debates WHERE id=:id');
	$prepare->bindValue(':id', $id, PDO::PARAM_INT);
	$prepare->execute();
	$debate = $prepare->fetch();

	$debateName 	= $debate['debateName'];
	$debateCate		= $debate['debateCate'];
	$debateImage	= $debate['debateImage'];
	$debateDesc		= $debate['debateDesc'];

	
?>

	
	<article class="featured_top">
      <div class="container">
        <div class="white_gradient">
          <div class="row">
            <div class="span12 align_center">
              <h1 class="boxer_title"><?php echo $debateName; ?></h1>
              <img src="<?php echo $debateImage ?>" alt="Debate image" class="debate-image">
              <p><?php echo $debateDesc ?></p>
            </div>
          </div>
        </div>
      </div>
    </article>

	<div class="container">
	    <div class="chat"></div>
		<form action="" class="form-chat" method="post">
		    <input type="text" class="write-field">
		    <input type="submit" value="Send" class="subwrite">
		    <input type="hidden" value="<?php echo $id ?>" class="hidden-id">
		    <input type="hidden" value="<?php echo $idSender ?>" class="hidden-idSender">
		    <input type="hidden" value="<?php echo $login ?>" class="hidden-loginSender">
		</form>
	</div>


<?php include ('../include/footer-debate.php'); ?>