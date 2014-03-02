<?php
session_start();

$nb_steps = get_steps();

/* Token generation and initialization of the current step */
if (empty($_SESSION['step'])) {
    $_SESSION['step']= 1;
    $_SESSION["token"] = generate_random_string();   
} else if ($_SESSION['step'] > $nb_steps) {
    $_SESSION['step']= 1;
    $_SESSION["token"] = generate_random_string();  
}

/* If some datas have been submited, we go to the next step */
if (!empty($_POST) && $_SESSION['step'] <= $nb_steps) {
    $id_answer = trim($_POST["id_answer"]);
    $token = $_SESSION["token"];
    $step = $_SESSION["step"];
    if (check_answer($id_answer,$step)) {
        $_SESSION["step"]++;
        add_user_answer($token,$id_answer);
        if ($_SESSION['step'] > $nb_steps) header ("Location:result.php");
    }
}

$progress = $_SESSION['step'] / $nb_steps * 100;
$question = get_question($_SESSION['step']);
$answers = get_answers($_SESSION['step']);