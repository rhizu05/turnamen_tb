<?php

class Tournament extends Controller
{
    public function create()
    {
        if (!isset($_SESSION['organizer'])) {
            header('Location: ' . BASEURL . '/organizer/login');
            exit;
        }

        $data['games'] = $this->model('GameModel')->getAll(); // Ambil daftar game
        $this->view('templates/headerOrganizer');
        $this->view('tournament/create', $data);
        $this->view('templates/footerOrganizer');
    }

    public function store()
    {
        if (!isset($_SESSION['organizer'])) {
            header('Location: ' . BASEURL . '/organizer/login');
            exit;
        }

        // Handle upload gambar
        $image_path = null;
        if (!empty($_FILES['image']['name'])) {
            $targetDir = 'public/uploads/';
            $fileName = uniqid() . '_' . basename($_FILES['image']['name']);
            $targetFilePath = $targetDir . $fileName;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                $image_path = $targetFilePath;
            }
        }

        $data = [
            'game_id' => $_POST['game_id'],
            'organizer_id' => $_SESSION['organizer']['id'],
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'prize_pool' => $_POST['prize_pool'],
            'max_teams' => $_POST['max_teams'],
            'registration_fee' => $_POST['registration_fee'],
            'registration_deadline' => $_POST['registration_deadline'],
            'allow_solo' => isset($_POST['allow_solo']) ? 1 : 0,
            'start_date' => $_POST['start_date'],
            'end_date' => $_POST['end_date'],
            'status' => $_POST['status'],
            'image_path' => $image_path
        ];

        if ($this->model('TournamentModel')->add($data)) {
            $_SESSION['success_message'] = "Turnamen berhasil dibuat!";
            header('Location: ' . BASEURL . '/organizer/dashboard');
            exit;
        } else {
            echo "Gagal menyimpan data turnamen!";
        }
    }

    public function edit($id)
    {
        if (!isset($_SESSION['organizer'])) {
            header('Location: ' . BASEURL . '/organizer/login');
            exit;
        }

        $data['tournament'] = $this->model('TournamentModel')->getTournamentById($id);
        $data['games'] = $this->model('GameModel')->getAll();
        $data['judul'] = 'Edit Turnamen';

        $this->view('templates/headerOrganizer', $data);
        $this->view('tournament/edit', $data);
        $this->view('templates/footerOrganizer');
    }

    public function delete($id)
    {
        if (!isset($_SESSION['organizer'])) {
            header('Location: ' . BASEURL . '/organizer/login');
            exit;
        }

        if ($this->model('TournamentModel')->delete($id)) {
            $_SESSION['success_message'] = 'Turnamen berhasil dihapus.';
        } else {
            $_SESSION['error_message'] = 'Gagal menghapus turnamen.';
        }

        header('Location: ' . BASEURL . '/organizer/dashboard');
        exit;
    }

    public function update($id)
    {
        $tournament = $this->model('TournamentModel')->getTournamentById($id);

        if (!$tournament) {
            $_SESSION['error_message'] = 'Turnamen tidak ditemukan.';
            header('Location: ' . BASEURL . '/organizer/dashboard');
            exit;
        }

        $data = $_POST;

        // Normalisasi tanggal
        if (isset($data['registration_deadline']) && $data['registration_deadline'] === '') {
            $data['registration_deadline'] = null;
        }


        // Tangani upload gambar jika ada
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $imageName = uniqid() . '_' . $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $imageName);
            $data['image_path'] = 'uploads/' . $imageName;
        } else {
            $data['image_path'] = $tournament['image_path'];
        }

        $data['id'] = $id;

        if ($this->model('TournamentModel')->update($data)) {
            $_SESSION['success_message'] = 'Turnamen berhasil diperbarui.';
        } else {
            $_SESSION['error_message'] = 'Gagal memperbarui turnamen.';
        }

        header('Location: ' . BASEURL . '/organizer/dashboard');
        exit;
    }

    // app/controllers/Tournament.php

    public function detail($id)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $model = $this->model('TournamentModel');

        // Ambil data turnamen lengkap (join game dan organizer)
        $tournament = $model->getDetailById($id);

        if (!$tournament) {
            header('Location: ' . BASEURL . '/home');
            exit;
        }

        $game = $this->model('GameModel')->getById($tournament['game_id']);
        $teamCount = $model->getRegisteredTeamCount($id);
        $teams = $model->getRegisteredTeams($id);
        $matches = $model->getMatchesByTournament($id);

        $now = date('Y-m-d');
        $registration_open = $tournament['status'] === 'upcoming' && $now <= $tournament['registration_deadline'];

        $this->view('tournament/detail', [
            'judul' => 'Detail - ' . $tournament['name'],
            'tournament' => $tournament,
            'game' => $game,
            'teamCount' => $teamCount,
            'teams' => $teams,
            'matches' => $matches,
            'registration_open' => $registration_open,
            'is_player_logged_in' => isset($_SESSION['player']),
        ]);

    }

    public function register($id)
{
    $tournamentModel = $this->model('TournamentModel');
    $tournament = $tournamentModel->getById($id); // Ambil data turnamen

    $this->view('tournament/register', [
        'judul' => 'Daftar Turnamen - ' . $tournament['name'],
        'tournament' => $tournament
    ]);
}

public function registerSave()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $teamName = $_POST['team_name'];
        $playerIds = $_POST['player_ids']; // array
        $tournamentId = $_POST['tournament_id'];
        $createdBy = 1; // Ubah ke $_SESSION['user']['id'] jika login

        $teamModel = $this->model('TeamModel');
        $teamMemberModel = $this->model('TeamMemberModel');

        // ✅ Validasi: Pastikan tidak ada player yang sudah terdaftar di turnamen ini
        foreach ($playerIds as $playerId) {
            if ($teamMemberModel->isPlayerRegistered($playerId, $tournamentId)) {
                $_SESSION['error_message'] = "Player dengan ID $playerId sudah terdaftar di turnamen ini.";
                header('Location: ' . BASEURL . '/tournament/detail/' . $tournamentId);
                exit;
            }
        }

        // Jika semua player valid, lanjutkan membuat tim
        $teamId = $teamModel->createTeam($teamName, $tournamentId, $createdBy);

        foreach ($playerIds as $playerId) {
            $teamModel->addTeamMember($teamId, $playerId);
        }

        $teamModel->registerTournament($tournamentId, $teamId, $createdBy);

        $_SESSION['success_message'] = "Tim berhasil didaftarkan ke turnamen!";
        header('Location: ' . BASEURL . '/tournament/detail/' . $tournamentId);
        exit;
    }
}

}





