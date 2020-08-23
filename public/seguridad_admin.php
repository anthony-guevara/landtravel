<?php

session_start();
if (isset($_SESSION["tipo"])) {
    if (($_SESSION["tipo"]=="Admin")) {
        header("Location: Tours.php");
    } else {
        header("Location: index.php");
    }
} else {
    header("Location: index.php");
}
