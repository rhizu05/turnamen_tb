<?php

class Games extends Controller {
    public function index($slug = null)
    {
        if ($slug) {
            $this->detail($slug);
        } else {
            header('Location: ' . BASEURL); // fallback
            exit;
        }
    }


    public function detail($slug)
    {
        // Kode yang sudah kamu punya
        $gameModel = $this->model('GameModel');
        $tournamentModel = $this->model('TournamentModel');

        $game = $gameModel->getGameBySlug($slug);
        if (!$game) {
            header('Location: ' . BASEURL);
            exit;
        }
        $status = $_GET['status'] ?? 'upcoming';

        $tournaments = $tournamentModel->getTournamentsByGameAndStatus($game['id'], $status);

        $data['judul'] = $game['name'];
        $data['game'] = $game;
        $data['tournaments'] = $tournaments;
        $data['status'] = $status;

        $this->view('templates/header', $data);
        $this->view('games/detail', $data);
        $this->view('templates/footer');
    }
}
