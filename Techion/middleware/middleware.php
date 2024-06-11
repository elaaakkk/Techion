<?php
session_start();
include("../koneksi.php");

function checkLogin() {
    if (!isset($_SESSION['email'])) {
        header("Location: ../SignUp.php");
        exit();
    }
}

function checkUserRole($role) {
    if (isset($_SESSION['usertype'])) {
        if ($_SESSION['usertype'] !== $role) {
            if ($_SESSION['usertype'] === 'admin') {
                header("Location: ../mentor/halaman.php");
                exit();
            } else {
                $_SESSION['flash_message'] = "You do not have permission!";
                header("Location: ../student/halaman.php");
                exit();
            }
        }
    }
}

function customerMiddleware() {
    checkLogin();
    checkUserRole('customer');
}

function adminMiddleware() {
    checkLogin();
    checkUserRole('admin');
}
?>
