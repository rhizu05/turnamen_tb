<?php

class Player extends Controller {
    public function login() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model = $this->model('PlayerModel');
            $player = $model->login($_POST['email']);

            if ($player && password_verify($_POST['password'], $player['password'])) {
                $_SESSION['player'] = $player;

                // ✅ Redirect ke halaman sebelum login
                if (isset($_SESSION['redirect_after_login'])) {
                    $redirect = $_SESSION['redirect_after_login'];
                    unset($_SESSION['redirect_after_login']);
                    header("Location: " . BASEURL . $redirect);
                } else {
                    header("Location: " . BASEURL . "/"); // fallback ke home
                }
                exit;
            } else {
                $error = "Email atau password salah!";
            }
        }

        $this->view('player/login', isset($error) ? ['error' => $error] : []);
    }

    public function register() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model = $this->model('PlayerModel');
            if ($model->register($_POST)) {
                header("Location: " . BASEURL . "/player/login");
                exit;
            } else {
                $error = "Registrasi gagal. Mungkin email sudah digunakan.";
            }
        }

        $this->view('player/register', isset($error) ? ['error' => $error] : []);
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_destroy();
        header("Location: " . BASEURL . "/player/login");
        exit;
    }

    public function index() {
        header("Location: " . BASEURL . "/player/register");
        exit;
    }
}
