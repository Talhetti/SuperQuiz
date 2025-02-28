<?php
session_start();

if (isset($_POST['Inciar'])) {
    header('Location: quiz.php');
    exit();
} else if (isset($_POST['Ranking'])) {
    header('Location: ranking.php');
    exit();
} else if (isset($_POST['Sair'])) {
    session_destroy();
    header('Location: login.php');
    exit();
}
