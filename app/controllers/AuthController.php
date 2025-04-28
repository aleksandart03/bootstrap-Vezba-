<?php

require_once __DIR__ . '/../models/User.php';

class AuthController
{
    public function showLogin()
    {
        require_once __DIR__ . '/../views/auth/login.php';
    }

    public function showRegister()
    {
        require_once __DIR__ . '/../views/auth/register.php';
    }

    public function login($email, $password)
    {
        session_start();

        $userModel = new User();
        $user = $userModel->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email']
            ];
            header('Location: index.php');
            exit();
        } else {
            echo "<script>alert('Pogrešan email ili lozinka.');window.location.href='login.php';</script>";
        }
    }

    public function register($username, $email, $password)
    {
        $userModel = new User();
        $existingUser = $userModel->findByEmail($email);

        if ($existingUser) {
            echo "<script>alert('Email je već registrovan.');window.location.href='register.php';</script>";
            return;
        }

        $userModel->create($username, $email, $password);
        echo "<script>alert('Uspešna registracija. Sada se možete prijaviti.');window.location.href='login.php';</script>";
    }
}
