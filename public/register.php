<?php
session_start();
require_once __DIR__ . '/../app/controllers/AuthController.php';

$auth = new AuthController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $auth->register($_POST['username'], $_POST['email'], $_POST['password']);
} else {
    $auth->showRegister();
}
