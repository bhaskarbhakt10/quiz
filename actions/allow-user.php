<?php

if (isset($_POST)) {
    // print_r($_POST);
    $username = "admin";
    $password = "admin@123";

    $resposnse_array = [];
    if ($_POST['username'] === $username && $_POST['password'] === $password) {
        $resposnse_array['resposnse'] = 1;
    } else {
        $resposnse_array['resposnse'] = 0;
    }

    echo json_encode($resposnse_array);
}
