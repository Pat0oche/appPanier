<?php

function afficherMsg() {
    if (isset($_SESSION['msg'])) {
        return $_SESSION['msg'];
    }
}