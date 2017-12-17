<?php
session_start();
?>

<?php

    print_r($_SESSION);
    if(!isset($_SESSION['login_user'])){
        echo '<script type="text/javascript">
                window.location = "pages/login.php"
             </script>';
    }
    else{
        echo '<script type="text/javascript">
                window.location = "pages/index.php"
             </script>';
    }

?>
