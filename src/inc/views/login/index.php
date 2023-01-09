<?php


    $page_title = "Simple App - Login";

    $user_key = "username";
    $pass_key = "password";
    


    if(Account::isLogged()) {
        header('location: /');
        return;
    }
    

    $error_message;

    if($_SERVER['REQUEST_METHOD'] == 'POST') {


        if (!isset($_POST[$user_key]) || isset($_POST[$user_key]) && strlen($_POST[$user_key]) < 4) {
             $error_message = "You must enter a username";
        } else if(!isset($_POST[$pass_key]) || isset($_POST[$pass_key]) && strlen($_POST[$pass_key]) < 1) {
            $error_message = "You need to enter your password";
        } else {

            // CREAR SISTEMA DE AUTENTICADO

            $username = $_POST[$user_key];
            $password = $_POST[$pass_key];


            $account = new Account($username, $page_db);


            $error_message = $account->login($password);


            if(empty($error_message)) {


                Account::set("logged", true);
                Account::set("username", $username);

                header("location: /");
                

            }

        }

        

    }


?>


<h1>Sign in to app</h1>

<form action="/login" method="post">

    <div id="body">

        <input type="text" name="username" placeholder="Username" maxlength="20">

        <input type="password" name="password" placeholder="Password">

    </div>



    <div id="footer">


        <?php 
        
            if(isset($error_message)) {
            echo "<p class='error-message'>$error_message</p>";
            }
        
        ?>

        <p>Don't have an account? <a href="/register">register here</a></p>

        <button type="submit">Login <i class="uil uil-angle-right-b"></i></button>
    </div>

</form>

<link rel="stylesheet" href="/assets/css/auth.css">