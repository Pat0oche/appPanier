<?php

function afficherMsg() {
    if (isset($_SESSION['msg'])) {
        $msg = $_SESSION['msg'];
        unset($_SESSION['msg']);
        return $msg;
    }
    return false;
}