<?php

class Organizer extends Controller {
    public function login() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model = $this->model('OrganizerModel');
            $organizer = $model->login($_POST['email']);
            if ($organizer && password_verify($_POST['password'], $organizer['password'])) {
                $_SESSION['organizer'] = $organizer;
                header("Location: " . BASEURL . "/organizer/dashboard");
                exit;
            } else {
                $error = "Email atau password salah!";
            }
        }

        $this->view('organizer/login', isset($error) ? ['error' => $error] : []);
    }

    public function register() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model = $this->model('OrganizerModel');
            if ($model->register($_POST)) {
                header("Location: " . BASEURL . "/organizer/login");
                exit;
            } else {
                $error = "Registrasi gagal. Mungkin email sudah terdaftar.";
            }
        }

        $this->view('organizer/register', isset($error) ? ['error' => $error] : []);
    }

    public function dashboard() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['organizer'])) {
            header("Location: " . BASEURL . "/organizer/login");
            exit;
        }

        $organizer_id = $_SESSION['organizer']['id'];
        $tournaments = $this->model('TournamentModel')->getByOrganizerId($organizer_id);

        $this->view('templates/headerOrganizer');
        $this->view('organizer/dashboard', [
            'organizer' => $_SESSION['organizer'],
            'tournaments' => $tournaments
        ]);
        $this->view('templates/footerOrganizer');
    }

    public function index() {
        header("Location: " . BASEURL . "/organizer/register");
        exit;
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_destroy();
        header("Location: " . BASEURL . "/organizer/login");
        exit;
    }
}
