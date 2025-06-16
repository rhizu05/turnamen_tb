<?php

class TeamMemberModel
{
    private $db; // <--- Tambahkan deklarasi ini!

    public function __construct()
    {
        $this->db = new Database;
    }

    public function isPlayerRegistered($player_id, $tournament_id)
    {
        $this->db->query("SELECT COUNT(*) as count 
                          FROM team_members 
                          JOIN teams ON team_members.team_id = teams.id 
                          WHERE team_members.player_id = :player_id 
                          AND teams.tournament_id = :tournament_id");

        $this->db->bind('player_id', $player_id);
        $this->db->bind('tournament_id', $tournament_id);
        $result = $this->db->single();

        return $result['count'] > 0;
    }
}
