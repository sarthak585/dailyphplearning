<?php
    /*
     * define the base ur.
     */
    define('BASE_URL', 'http://localhost/Admin/');
    define('USER_ROLE_ADMIN', 'admin');

    /*
     * Initialize session.
     * Authenticate users based on session value.
     */
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($doNotAuthenticate)||($doNotAuthenticate != true)) {
        if (!isset($_SESSION['isAuthenticated']) || ($_SESSION['isAuthenticated'] != true) || ($_SESSION['userrole'] != USER_ROLE_ADMIN)) {
            echo "Access Denied";
            header('location: ' . BASE_URL . 'registration_view.php');
            exit;
        }
    }
    include_once 'connect_db.php';
?>	