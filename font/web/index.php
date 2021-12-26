
<DOCTYPE.html>
    <html lang="en">

    <head>
        <link rel="stylesheet" type="text/css" href="./admin.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <meta charset="UTF-8">
        <meta http-equiv="X UA Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Quản lí thông tin</title>
        
        
    </head>

    <body>
    <?php
    //tạo session bằng thông tin từ phần login
    session_start();
$name=('asas');
$_SESSION['name']=$name;
$type=('A1');
$_SESSION['type']=$type;
$user_id = ('4');
$_SESSION['user_id'] = $user_id;
?>

<?php
include_once './js/js.php';
?>
        <style>
            
        <?php include_once './admin.css' ?>
        </style>
        <div class="container">
        <?php include_once './header.php'?>
        <div class="content-div">
        <?php include_once './left.php'?>
        <?php
            if (isset($_GET['st'])) {
                $status = $_GET['st'];
            } else {
                if ($type == 'B2') {
                    $status = 'official';
                } else {
                $status = 'local';
                }
            }
            if ($status == 'local') {
                if ($type == 'A1') {
                    include_once './local/tw.php';
                } else if ($type == 'A2') {
                    include_once './local/province.php';
                } else if ($type == 'A3') {
                    include_once './local/district.php';
                } else if ($type == 'B1') {
                    include_once './local/commune.php';
                } else {
                    include_once './resident/index.php';
                }
            } else include_once './'.$status.'/index.php';
            ?>
        </div>
    </div>
    
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        
    </body>
    </body>

    </html>