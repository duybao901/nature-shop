<?php
ob_start();
session_start();
$variable = isset($_GET['type']) ?  $_GET['type'] : 'default';

switch ($variable) {
    case 'remove':
        $id_sp = $_GET["id_sp"];
        unset($_SESSION['carts'][$id_sp]);
        $location =  isset($_GET['location']) ?  $_GET['location'] : 'home';
        if (isset($location)) {
            echo "<script>
           window.location.href='$location';
        </script>";
        } else {
            header('location: home.php');
        }
        if (count($_SESSION['carts']) == 0) {
            unset($_SESSION['carts']);
        }
        break;
    default:
        $id_sp = $_GET["id_sp"];
        if (isset($_SESSION['carts'][$id_sp])) {
            $_SESSION['carts'][$id_sp] = $_SESSION['carts'][$id_sp] + 1;
        } else {
            $_SESSION['carts'][$id_sp] = 1;
        }
        header("location: detail.php?chitiet=$id_sp");
        break;
}
