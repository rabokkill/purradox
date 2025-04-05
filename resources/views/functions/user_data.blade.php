<?php
    function fetch_data($conn) {
        if(isset($_SESSION['userID'])){
            $userID = $_SESSION['userID'];
            $query = "SELECT * FROM tbl_users WHERE userID = '$userID' LIMIT 1"; 

            $result = mysqli_query($conn,$query);
            if($result && mysqli_num_rows($result) == 1) {
                $user_data = mysqli_fetch_assoc($result);
                return $user_data;
            }
        }
    }
?>