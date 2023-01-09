<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    

<?php

session_start();

include("./inc/database.php");
include './inc/config.php';
include './inc/account.php';

$page_db = new Database($page_config['db-host'], $page_config['db-user'], $page_config['db-password'], $page_config['db-name']);
$page_title = "Simple Login Register";




$request_path = $_SERVER['REQUEST_URI'];

$pos = strpos($request_path, "?");


if($pos) {
    $request_path = substr($request_path, 0, $pos - 1);
}

function buildRoute($rt) {
    
    $path =  __DIR__ . "/inc/views";

    if(str_ends_with($rt, "/")) {
        $path = $path . $rt . "index.php";
    } else {
        $path = $path . $rt . "/index.php";
    }

    return $path;
} 



$route = buildRoute($request_path);


if(!file_exists($route)) {

    http_response_code(404);

    include(buildRoute("/404"));
} else {
    include($route);
}



?>

</body>

<script id="php-load">
    document.title = '<?php echo $page_title ?>';


    document.querySelector("script#php-load").remove();
</script>
</html>
