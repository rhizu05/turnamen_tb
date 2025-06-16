<?php
class TeamModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database(); // gunakan PDO
    }

    public function createTeam($name, $tournament_id, $created_by)
    {
        $query = "INSERT INTO teams (name, tournament_id, created_by, created_at) 
                  VALUES (:name, :tournament_id, :created_by, NOW())";
        $this->db->query($query);
        $this->db->bind(':name', $name);
        $this->db->bind(':tournament_id', $tournament_id);
        $this->db->bind(':created_by', $created_by);
        $this->db->execute();
        return $this->db->lastInsertId();
    }

    public function addTeamMember($team_id, $player_id)
    {
        $query = "INSERT INTO team_members (team_id, player_id) VALUES (:team_id, :player_id)";
        $this->db->query($query);
        $this->db->bind(':team_id', $team_id);
        $this->db->bind(':player_id', $player_id);
        $this->db->execute();
    }

    public function registerTournament($tournament_id, $team_id, $registered_id)
    {
        $query = "INSERT INTO tournament_registrations (tournament_id, team_id, registered_at, status) 
                  VALUES (:tournament_id, :team_id, :registered_at, 'pending')";
        $this->db->query($query);
        $this->db->bind(':tournament_id', $tournament_id);
        $this->db->bind(':team_id', $team_id);
        $this->db->bind(':registered_at', date('Y-m-d H:i:s'));
        $this->db->execute();
    }
}
