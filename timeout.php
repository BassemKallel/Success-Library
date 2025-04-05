<?php
    session_start();
    $timeout_duration = 60*15;
    if (isset($_SESSION['last_activity'])) {
        $elapsed_time = time() - $_SESSION['last_activity'];
        if ($elapsed_time > $timeout_duration) {
            include 'logout.php';
        }
    }
    $_SESSION['last_activity'] = time();
?>