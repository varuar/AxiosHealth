//I certify that this submission is my own original work-Alvin Varughese

<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $_SESSION = array();
    session_destroy();
}

header("Location: http://localhost/AxiosHealth/index.php");
exit;
?>
