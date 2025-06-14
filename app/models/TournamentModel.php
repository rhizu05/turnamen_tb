<?php

class TournamentModel {
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

   public function getTournamentsByGameAndStatus($gameId, $status)
    {
        // contoh query sederhana, sesuaikan dengan tabel turnamen kamu
        $this->db->query("SELECT * FROM tournaments WHERE game_id = :game_id AND status = :status ORDER BY start_date ASC");
        $this->db->bind('game_id', $gameId);
        $this->db->bind('status', $status);
        return $this->db->resultSet();
    }


    public function getTournamentById($id)
    {
        $this->db->query("SELECT * FROM tournaments WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getByOrganizerId($organizer_id)
    {
        $this->db->query("SELECT t.*, g.name AS game FROM tournaments t 
                        JOIN games g ON t.game_id = g.id 
                        WHERE t.organizer_id = :organizer_id 
                        ORDER BY t.start_date DESC");
        $this->db->bind(':organizer_id', $organizer_id);
        return $this->db->resultSet();
    }


    public function add($data) {
        $this->db->query("INSERT INTO tournaments 
            (game_id, organizer_id, name, description, prize_pool, max_teams, registration_fee, registration_deadline, allow_solo, start_date, end_date, status, image_path)
            VALUES 
            (:game_id, :organizer_id, :name, :description, :prize_pool, :max_teams, :registration_fee, :registration_deadline, :allow_solo, :start_date, :end_date, :status, :image_path)");

        $this->db->bind(':game_id', $data['game_id']);
        $this->db->bind(':organizer_id', $data['organizer_id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':prize_pool', $data['prize_pool']);
        $this->db->bind(':max_teams', $data['max_teams']);
        $this->db->bind(':registration_fee', $data['registration_fee']);
        $this->db->bind(':registration_deadline', $data['registration_deadline']);
        $this->db->bind(':allow_solo', $data['allow_solo']);
        $this->db->bind(':start_date', $data['start_date']);
        $this->db->bind(':end_date', $data['end_date']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':image_path', $data['image_path']);

        return $this->db->execute();
    }

    public function update($data)
    {
        $this->db->query("UPDATE tournaments SET 
            name = :name,
            description = :description,
            prize_pool = :prize_pool,
            max_teams = :max_teams,
            registration_fee = :registration_fee,
            registration_deadline = :registration_deadline,
            allow_solo = :allow_solo,
            start_date = :start_date,
            end_date = :end_date,
            status = :status,
            image_path = :image_path
            WHERE id = :id");

        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':prize_pool', $data['prize_pool']);
        $this->db->bind(':max_teams', $data['max_teams']);
        $this->db->bind(':registration_fee', $data['registration_fee']);
        $this->db->bind(':registration_deadline', $data['registration_deadline']);
        $this->db->bind(':allow_solo', $data['allow_solo']);
        $this->db->bind(':start_date', $data['start_date']);
        $this->db->bind(':end_date', $data['end_date']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':image_path', $data['image_path']);
        $this->db->bind(':id', $data['id']);

        return $this->db->execute();
    }

    public function delete($id)
    {
        $this->db->query("DELETE FROM tournaments WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function getDetailById($id)
    {
        $query = "SELECT t.*, g.name AS game_name, g.image_path AS game_logo, o.org_name AS organizer_name
                FROM tournaments t
                JOIN games g ON t.game_id = g.id
                JOIN organizers o ON t.organizer_id = o.id
                WHERE t.id = :id";

        $this->db->query($query);
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // 1. Jumlah tim yang terdaftar
    public function getRegisteredTeamCount($tournamentId) {
        $this->db->query("SELECT COUNT(*) as total FROM tournament_registrations WHERE tournament_id = :id");
        $this->db->bind(':id', $tournamentId);
        $result = $this->db->single();
        return $result['total'];
    }


    // 2. Daftar tim yang sudah daftar
    public function getRegisteredTeams($tournamentId) {
        $this->db->query("SELECT teams.name FROM tournament_registrations 
            JOIN teams ON tournament_registrations.team_id = teams.id 
            WHERE tournament_registrations.tournament_id = :id");
        $this->db->bind(':id', $tournamentId);
        return $this->db->resultSet();
    }

    public function getMatchesByTournament($tournamentId) {
        $this->db->query("
            SELECT m.*, 
                t1.name AS team1_name, 
                t2.name AS team2_name 
            FROM matches m 
            JOIN teams t1 ON m.team1_id = t1.id 
            JOIN teams t2 ON m.team2_id = t2.id 
            WHERE m.tournament_id = :id
        ");
        $this->db->bind(':id', $tournamentId);
        return $this->db->resultSet();
    }

}
