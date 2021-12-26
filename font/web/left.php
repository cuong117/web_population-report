<?php
$name = $_SESSION['name'];
$type = $_SESSION['type'];
?>
<div class="left-div">
        <div class="user-div">
            <div class="row">
            <i class="material-icons">account_circle</i>
            <span>Người dùng: <?php echo $name?></span>
            </div>
        <div class="row">
        <i class="material-icons">admin_panel_settings</i>
        <span>Quyền truy cập: <?php echo $type?></span>
        </div>
        </div>
    </div>