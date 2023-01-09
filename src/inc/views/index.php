<?php



    if(!Account::isLogged()) {
        header('location: /login');

        return;
    }



    if(isset($_GET['signout'])) {
        Account::logout();
        header("location: /");
        return;
    }



?>


<h1>You are logged by: <?php echo Account::get("username"); ?></h1>

<a href="/?signout">Logout</a>