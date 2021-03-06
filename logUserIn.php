<?php
    require_once('database.php');

    $username = filter_input(INPUT_POST, 'userName');
    $passwords = filter_input(INPUT_POST, 'user_Password');

    $queryUsers = "SELECT * FROM user WHERE username=:userName AND passwords=:user_Password";

    $execStatement = $db->prepare($queryUsers);
    $execStatement->bindValue(':userName', $username);
    $execStatement->bindValue(':user_Password', $passwords);


    $execStatement->execute();

    $userList = $execStatement->fetchAll();
    $userRowCount = $execStatement->rowCount();
    $execStatement->closeCursor();

    if($userRowCount == 0)
    {
        header("location: login.php?error=notFound");
    }
    else {
        session_start();
        $_SESSION["username"] = ":username";
        header("location: login.php?noError");
    }

?>