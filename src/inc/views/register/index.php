<?php


    $page_title = "Simple App - Register";

    $user_key = "username";
    $pass_key = "password";
    $repass_key = "repassword";

    


    if(Account::isLogged()) {
        header('location: /');
        return;
    }
    

    $error_message;

    if($_SERVER['REQUEST_METHOD'] == 'POST') {


        if (!isset($_POST[$user_key]) || isset($_POST[$user_key]) && strlen($_POST[$user_key]) < 4) {
             $error_message = "You must enter a username";
        } else if(!isset($_POST[$pass_key]) || isset($_POST[$pass_key])) {
            $error_message = "You need to enter your password";
        } else if(strlen($_POST[$pass_key]) < 8) {
            $error_message = "The password is too short, try another one.";
        } else if(!isset($_POST[$repass_key]) || isset($_POST[$repass_key])) {
            $error_message = "You need to repeat the password";
        } else if($_POST[$pass_key] !== $_POST[$repass_key]) {
            $error_message = "Passwords do not match";
        } else {


            $username = $_POST[$user_key];
            $password = $_POST[$pass_key];

            $account = new Account($username, $page_db);

            $error_message = $account->register($password);

            if(!isset($error_message)) {


                header("location: /login");

            }

        }

        

    }


?>


<h1>Sign up to app</h1>

<form action="/register" method="post" accept="">

    <div id="body">

        <input type="text" name="username" required placeholder="Username" minlength="4" maxlength="20">

        <input type="password" name="password" required placeholder="Password" minlength="8" maxlength="20">

        <input type="password" name="repassword" placeholder="Repeat password" minlength="8" maxlength="20">

    </div>



    <div id="footer">


        <?php 
        
            if(isset($error_message)) {
                echo "<p class='error-message'>$error_message</p>";
            }
        
        ?>

        <p>Do you have an account? <a href="/login">login here</a></p>

        <button type="submit">Register <i class="uil uil-angle-right-b"></i></button>
    </div>

</form>

<link rel="stylesheet" href="/assets/css/auth.css">