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
                $status = 'local';
            }
            if (isset($_GET['act'])) {
                $action = $_GET['act'];
            } else {
                $action = 'index';
            }
            ?>
                <?php
            include_once './'.$status.'/'.$action.'.php';
        ?>
        </div>
    </div>
    
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="./js/js.js"></script>
    </body>
    </body>

    </html>
    <script>
    fetch_data();
</script>