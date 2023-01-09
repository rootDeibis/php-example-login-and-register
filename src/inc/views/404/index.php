<?php
    http_response_code(404);


    $page_title = "Page not found";

?>


<div>
    <h1>Page not found</h1>
    <p>Page could not be found, <a href="/">click here to return</a>.</p>
</div>


<style>

    body {
        height: 100vh;

        display: flex;
        align-items: center;
        justify-content: center;
    }

    div {
        text-align: center;
    }

    h1 {
        color: red;
        text-transform: uppercase;
    }
</style>