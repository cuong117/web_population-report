<?php
    include("../config/config.php");
    if (isset($_POST['action'])) {
        $output ='';
        if ($_POST['action'] == 'fetch_data') {
            $query = "SELECT * FROM data";
            get_data($query);
        }
    }
    function get_data($query) {
        include("../config/config.php");
        $output = "";
        $total_row = mysqli_query($connect, $query) or die('error');
        if (mysqli_num_rows($total_row) > 0) {
            foreach($total_row as $row) {
            $output.= '<tr>
        <td>'.$row["ID"].'</td>
        <td>'.$row["Tên tỉnh"].'</td>
        <td>'.$row["Dân số"].'</td>
        <td>'.$row["Số lượng cán bộ"].'</td>
        <td>'.$row["Tiến trình"].'</td>
        <td><button>Sửa<i class="material-icons">
        edit_calendar
        </i></button>
        <button>Xóa<i class="material-icons">
        delete
        </i></button></td>
    </tr>';
            }
        } else {
            $output = "<h1>Data not found</h1>";
        }
        echo $output;
    }